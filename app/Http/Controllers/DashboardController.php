<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\UserPlan;
use App\Models\Payment;
use App\Models\GoldRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Dynamic Dashboard Home
    public function index()
    {
        $userId = Auth::id();
        $activePlans = UserPlan::where('user_id', $userId)->where('status', 'active')->count();
        $closedPlans = UserPlan::where('user_id', $userId)->whereIn('status', ['cancelled', 'completed'])->count();
        $totalPaid = Payment::where('user_id', $userId)->where('status', 'success')->sum('amount');
        
        // Calculate gold weight: total_paid / current 22k rate per gram
        $latestRate = GoldRate::latest()->first();
        $goldWeight = 0;
        if ($latestRate && $latestRate->rate_22k > 0) {
            $goldWeight = round($totalPaid / $latestRate->rate_22k, 2);
        }
        
        // Get the user's latest active plan for the detail card
        $latestPlan = UserPlan::where('user_id', $userId)->where('status', 'active')->with('plan')->latest()->first();
        
        return view('dashboard.index', compact('activePlans', 'closedPlans', 'totalPaid', 'goldWeight', 'latestRate', 'latestPlan'));
    }

    // Show the user's active plans
    public function myPlans()
    {
        $userPlans = UserPlan::where('user_id', Auth::id())
            ->where('status', 'active')
            ->with('plan')
            ->get();
        return view('dashboard.my-plans', compact('userPlans'));
    }

    // Show the user's closed plans
    public function closedPlans()
    {
        $userPlans = UserPlan::where('user_id', Auth::id())
            ->whereIn('status', ['cancelled', 'completed'])
            ->with('plan')
            ->get();
        return view('dashboard.closed-plans', compact('userPlans'));
    }

    // Process an EMI Payment
    public function payEmi($id)
    {
        $userPlan = UserPlan::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('plan')
            ->firstOrFail();

        if ($userPlan->status !== 'active') {
            return back()->with('error', 'This plan is not active.');
        }

        // 1. Update the UserPlan totals
        $userPlan->installments_paid += 1;
        $userPlan->total_paid += $userPlan->monthly_installment;

        // 2. Check if the plan is completed
        if ($userPlan->installments_paid >= $userPlan->plan->duration_months) {
            $userPlan->status = 'completed';
        }

        $userPlan->save();

        // 3. Log the payment for history
        Payment::create([
            'user_id' => Auth::id(),
            'user_plan_id' => $userPlan->id,
            'amount' => $userPlan->monthly_installment,
            'transaction_id' => 'TXN-' . strtoupper(uniqid()),
            'status' => 'success'
        ]);

        return back()->with('success', 'EMI Paid Successfully!');
    }

    // View Payment History
    public function paymentHistory()
    {
        $payments = Payment::where('user_id', Auth::id())
            ->with('userPlan.plan') // Load the plan details
            ->latest()
            ->get();

        return view('dashboard.payment-history', compact('payments'));
    }


    // Show details for a specific user plan
    public function planDetails($id)
    {
        // Find the user's plan, make sure it belongs to the logged-in user
        $userPlan = UserPlan::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('plan')
            ->firstOrFail();

        return view('dashboard.plan-details', compact('userPlan'));
    }


    // Show the enrollment form
    public function newPlan()
    {
        $plans = Plan::all();
        return view('dashboard.new-plan', compact('plans'));
    }



    // Process the enrollment
    public function enroll(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'monthly_installment' => 'required|numeric'
        ]);

        $plan = Plan::findOrFail($request->plan_id);

        if ($request->monthly_installment < $plan->minimum_amount) {
            return back()->with('error', 'Installment must be at least ₹' . $plan->minimum_amount);
        }



        UserPlan::create([
            'user_id' => Auth::id(),
            'plan_id' => $plan->id,
            'monthly_installment' => $request->monthly_installment,
            'status' => 'active',
            'start_date' => Carbon::now(),
            'maturity_date' => Carbon::now()->addMonths($plan->duration_months),
        ]);

        return redirect('/dashboard/my-plans')->with('success', 'Successfully enrolled in the plan!');
    }

    // Close/Cancel an active plan
    public function closePlan($id)
    {
        $userPlan = UserPlan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($userPlan->status !== 'active') {
            return back()->with('error', 'This plan is already closed.');
        }

        $userPlan->update([
            'status' => 'cancelled'
        ]);

        return back()->with('success', 'Plan has been successfully closed. Please visit the store for any settlement.');
    }
}
