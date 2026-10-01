<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

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

        $products = $query->with('collection')->paginate(12)->withQueryString();
        
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

    public function store(StoreProductRequest $request)
    {
        $this->productService->createProduct($request->validated(), $request->file('image'));

        return back()->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $collections = \App\Models\Collection::all();
        return view('admin.edit-product', compact('product', 'collections'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->productService->updateProduct($product, $request->validated(), $request->file('image'));

        return redirect('/admin/products')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->productService->deleteProduct($product);

        return back()->with('success', 'Product deleted successfully.');
    }
}
