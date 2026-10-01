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

        Plan::create($request->only('name', 'short_description', 'duration_months', 'minimum_amount'));

        return back()->with('success', 'Plan added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        $plans = Plan::all();
        return view('admin.edit-plan', compact('plan', 'plans'));
    }

    // Update a plan
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'short_description' => 'required',
            'duration_months' => 'required|integer',
            'minimum_amount' => 'required|numeric',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update($request->only('name', 'short_description', 'duration_months', 'minimum_amount'));

        return redirect('/admin/plans')->with('success', 'Plan updated successfully!');
    }

    // Delete a plan
    public function destroy($id)
    {
        Plan::findOrFail($id)->delete();
        return back()->with('success', 'Plan deleted successfully!');
    }
}