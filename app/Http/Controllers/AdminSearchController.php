<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Appointment;
use App\Models\SavingPlan;

class AdminSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');
        
        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Search Customers (Users)
        $users = User::where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%")
                    ->take(3)
                    ->get()
                    ->map(function($user) {
                        return [
                            'type' => 'Customer',
                            'title' => $user->name,
                            'subtitle' => $user->phone ?? $user->email,
                            'url' => '#' // Replace with actual customer detail view later
                        ];
                    });
        
        $results = array_merge($results, $users->toArray());

        // Search Products
        $products = Product::where('name', 'like', "%{$query}%")
                        ->orWhere('sku', 'like', "%{$query}%")
                        ->take(3)
                        ->get()
                        ->map(function($product) {
                            return [
                                'type' => 'Product',
                                'title' => $product->name,
                                'subtitle' => '₹' . number_format($product->price),
                                'url' => url('/product/' . $product->id)
                            ];
                        });
        
        $results = array_merge($results, $products->toArray());

        // Search Appointments
        $appointments = Appointment::where('name', 'like', "%{$query}%")
                            ->orWhere('phone', 'like', "%{$query}%")
                            ->take(3)
                            ->get()
                            ->map(function($apt) {
                                return [
                                    'type' => 'Appointment',
                                    'title' => 'Apt: ' . $apt->name,
                                    'subtitle' => $apt->appointment_date,
                                    'url' => url('/admin/appointments')
                                ];
                            });

        $results = array_merge($results, $appointments->toArray());

        return response()->json($results);
    }
}
