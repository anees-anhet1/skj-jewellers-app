<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Show the user's wishlist page
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('dashboard.wishlist', compact('wishlists'));
    }

    // Add or remove a product from the wishlist
    public function toggle(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $existing = Wishlist::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->first();

        if ($existing) {
            $existing->delete(); // Remove it if it's already there
            return back()->with('success', 'Removed from wishlist!');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id
            ]);
            return back()->with('success', 'Added to wishlist!');
        }
    }
}
