<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OfferController extends Controller
{
    public function userIndex(Request $request)
    {
        $offers = Offer::whereDate('valid_till', '>=', Carbon::today())
            ->latest()
            ->get();
            
        $query = \App\Models\Product::query();
        
        $hasFeatured = \App\Models\Product::where('is_featured', true)->exists();
        if ($hasFeatured) {
            $query->where('is_featured', true);
        }
        
        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }
        
        $offerProducts = $query->inRandomOrder()->take(8)->get();

        return view('pages.offers', compact('offers', 'offerProducts'));
    }

    // Admin page - show all offers
    // This allows admin to edit an expired offer and extend its date
    public function adminIndex()
    {
        $offers = Offer::latest()->get();

        return view('admin.offers', compact('offers'));
    }

    // Add new offer
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'discount' => 'required|integer|min:0|max:100',
            'valid_till' => 'required|date|after_or_equal:today',
        ]);

        Offer::create($request->only('title', 'discount', 'valid_till'));

        return redirect('/admin/offers');
    }

    // Show edit page
    public function edit($id)
    {
        $offer = Offer::findOrFail($id);

        return view('admin.edit-offer', compact('offer'));
    }

    // Update existing offer
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'discount' => 'required|integer|min:0|max:100',
            'valid_till' => 'required|date|after_or_equal:today',
        ]);

        $offer = Offer::findOrFail($id);

        $offer->update([
            'title' => $request->title,
            'discount' => $request->discount,
            'valid_till' => $request->valid_till,
        ]);

        return redirect('/admin/offers');
    }

    // Delete offer
    public function destroy($id)
    {
        Offer::destroy($id);

        return redirect('/admin/offers');
    }
}