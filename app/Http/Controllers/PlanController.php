<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    // Public page to show available plans
    public function userIndex()
    {
        $plans = Plan::all();
        return view('pages.gold-saving-scheme', compact('plans'));
    }

    // Admin page to manage plans
    public function adminIndex()
    {
        $plans = Plan::all();
        return view('admin.plans', compact('plans'));
    }

    // Save a new plan from the admin panel
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_description' => 'required',
            'duration_months' => 'required|integer',
            'minimum_amount' => 'required|numeric',
        ]);

        Plan::create($request->all());

        return back()->with('success', 'Plan added successfully!');
    }

    // Delete a plan
    public function destroy($id)
    {
        Plan::findOrFail($id)->delete();
        return back()->with('success', 'Plan deleted successfully!');
    }
}
