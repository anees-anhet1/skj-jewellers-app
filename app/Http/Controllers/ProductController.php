<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Public Methods
    public function shopIndex(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Collection Filter
        if ($request->filled('collection_id')) {
            $query->where('collection_id', $request->collection_id);
        }

        // Category Filter
        // Note: For checkboxes, category could be an array. We'll handle both string and array just in case.
        if ($request->filled('category')) {
            if (is_array($request->category)) {
                $query->whereIn('category', $request->category);
            } else {
                $query->where('category', $request->category);
            }
        }

        // Sorting
        if ($request->filled('sort')) {
            if ($request->sort == 'price_low') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_high') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'newest') {
                $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $products = $query->paginate(12)->withQueryString();
        
        // Pass categories to build the dynamic sidebar
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('pages.shop', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product', compact('product'));
    }

    public function collectionsIndex()
    {
        $collections = \App\Models\Collection::all();
        return view('pages.collections', compact('collections'));
    }

    // Admin Methods
    public function adminIndex()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        $collections = \App\Models\Collection::all();
        return view('admin.products', compact('products', 'collections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'collection_id' => 'nullable|exists:collections,id',
        ]);

        $data = $request->except('image');
        $data['is_featured'] = $request->has('is_featured');
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return back()->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $collections = \App\Models\Collection::all();
        return view('admin.edit-product', compact('product', 'collections'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
            'collection_id' => 'nullable|exists:collections,id',
        ]);

        $data = $request->except('image');
        $data['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect('/admin/products')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return back()->with('success', 'Product deleted successfully.');
    }
}
