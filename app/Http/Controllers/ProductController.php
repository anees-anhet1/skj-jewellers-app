<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Public Methods
    public function shopIndex()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('pages.shop', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.product', compact('product'));
    }

    public function collectionsIndex()
    {
        $categories = Product::select('category')->distinct()->pluck('category');
        return view('pages.collections', compact('categories'));
    }

    // Admin Methods
    public function adminIndex()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.products', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
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
        return view('admin.edit-product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image',
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
