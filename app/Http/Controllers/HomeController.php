<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $newArrivals = \App\Models\Product::with('collection')->where('is_new_arrival', true)->latest()->take(4)->get();
        $collections = \App\Models\Collection::latest()->take(8)->get();
        return view('pages.home', compact('newArrivals', 'collections'));
    }
}
