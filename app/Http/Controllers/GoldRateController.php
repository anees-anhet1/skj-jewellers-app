<?php

namespace App\Http\Controllers;

use App\Models\GoldRate;
use Illuminate\Http\Request;

class GoldRateController extends Controller
{
    // Admin's Gold Rate page — shows the form, history, and comparison
    public function adminIndex()
    {
        $rate = GoldRate::latest()->first();
        $history = GoldRate::latest()->take(10)->get();
        $previous = GoldRate::latest()->skip(1)->first();

        return view('admin.gold-rate', compact('rate', 'history', 'previous'));
    }

    // Admin publishes a new rate
    public function store(Request $request)
    {
        $request->validate([
            'rate_24k' => 'required|numeric|min:0.01',
            'rate_22k' => 'required|numeric|min:0.01|lt:rate_24k',
            'rate_silver' => 'required|numeric|min:0.01',
        ], [
            'rate_22k.lt' => 'The 22K rate must be less than the 24K rate.',
        ]);

        GoldRate::create($request->only('rate_24k', 'rate_22k', 'rate_silver'));

        return redirect('/admin/gold-rate')->with('success', 'Gold rate published!');
    }

    // Public Gold Rate page
    public function userIndex()
    {
        $rate = GoldRate::latest()->first();
        return view('pages.gold-rate', compact('rate'));
    }
}