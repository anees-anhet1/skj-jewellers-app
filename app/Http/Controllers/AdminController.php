<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalCustomers = \App\Models\User::where('role', '!=', 'admin')->count();
        $newCustomersThisMonth = \App\Models\User::where('role', '!=', 'admin')->whereMonth('created_at', now()->month)->count();
        $activePlans = \App\Models\UserPlan::where('status', 'active')->count();
        $totalRevenue = \App\Models\Payment::where('status', 'success')->sum('amount');
        $totalProducts = \App\Models\Product::count();
        $latestRate = \App\Models\GoldRate::latest()->first();
        $recentPayments = \App\Models\Payment::with('user')->latest()->take(5)->get();
        
        return view('admin.index', compact(
            'totalCustomers', 'newCustomersThisMonth', 'activePlans', 
            'totalRevenue', 'totalProducts', 'latestRate', 'recentPayments'
        ));
    }

    public function customers()
    {
        $customers = \App\Models\User::where('role', '!=', 'admin')->withCount(['plans' => function($query) {
            $query->where('status', 'active');
        }])->latest()->get();
        
        return view('admin.customers', compact('customers'));
    }

    public function destroyCustomer($id)
    {
        $customer = \App\Models\User::where('role', '!=', 'admin')->findOrFail($id);

        \Illuminate\Support\Facades\DB::transaction(function () use ($customer) {
            // Delete related records first
            \App\Models\Payment::where('user_id', $customer->id)->delete();
            \App\Models\UserPlan::where('user_id', $customer->id)->delete();
            \App\Models\Wishlist::where('user_id', $customer->id)->delete();
            $customer->delete();
        });

        return back()->with('success', 'Customer "' . $customer->name . '" has been deleted.');
    }

    public function payments()
    {
        $payments = \App\Models\Payment::with(['user', 'userPlan.plan'])->latest()->get();
        return view('admin.payments', compact('payments'));
    }

    public function settings()
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->only(['store_name', 'support_email', 'support_phone']);
        
        foreach ($data as $key => $value) {
            if ($value !== null) {
                \App\Models\Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
        }
        
        return back()->with('success', 'Settings updated successfully.');
    }

    public function reports()
    {
        $revenueThisMonth = \App\Models\Payment::where('status', 'success')
            ->whereMonth('created_at', now()->month)
            ->sum('amount');
            
        $newEnrollments = \App\Models\UserPlan::whereMonth('created_at', now()->month)->count();
        $closedPlans = \App\Models\UserPlan::where('status', 'completed')->count();

        // Get daily revenue for chart
        $dailyRevenue = \App\Models\Payment::where('status', 'success')
            ->whereMonth('created_at', now()->month)
            ->selectRaw('DATE(created_at) as date, sum(amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.reports', compact('revenueThisMonth', 'newEnrollments', 'closedPlans', 'dailyRevenue'));
    }
}
