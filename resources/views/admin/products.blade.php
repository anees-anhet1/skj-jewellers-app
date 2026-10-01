@extends('layouts.admin')
@section('page-title', 'Products')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-serif font-semibold">Catalogue</h2>
        <button onclick="document.getElementById('addProductModal').classList.toggle('hidden')"
            class="btn-gold !py-2 !px-5 text-sm">+ Add Product</button>
    </div>

    {{-- Add Product Form --}}
    <div id="addProductModal" class="hidden card p-6 mb-6">
        <form action="{{ url('/admin/products') }}" method="POST" enctype="multipart/form-data"
            class="grid md:grid-cols-2 gap-4">
            @csrf
            <input type="text" name="name" placeholder="Product Name" required
                class="px-4 py-3 rounded-xl border border-gold-100">
            <select name="category" required class="px-4 py-3 rounded-xl border border-gold-100">
                <option value="">Select Category</option>
                <option>Gold</option>
                <option>Silver</option>
                <option>Diamond</option>
                <option>Platinum</option>
            </select>
            <select name="collection_id" class="px-4 py-3 rounded-xl border border-gold-100">
                <option value="">No Collection</option>
                @foreach($collections as $collection)
                    <option value="{{ $collection->id }}">{{ $collection->name }}</option>
                @endforeach
            </select>
            <input type="number" name="price" step="0.01" placeholder="Price" required
                class="px-4 py-3 rounded-xl border border-gold-100">
            <input type="number" name="mrp" step="0.01" placeholder="MRP (Optional, for Sale items)"
                class="px-4 py-3 rounded-xl border border-gold-100">
            <input type="text" name="weight" placeholder="Weight (e.g. 10g)"
                class="px-4 py-3 rounded-xl border border-gold-100">
            <textarea name="description" placeholder="Description"
                class="px-4 py-3 rounded-xl border border-gold-100 md:col-span-2"></textarea>
            <input type="file" name="image" accept="image/*" class="px-4 py-3 rounded-xl border border-gold-100">
            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2 cursor-pointer text-sm">
                    <input type="checkbox" name="is_featured" value="1" class="accent-gold-600"> Featured
                </label>
                <label class="flex items-center gap-2 cursor-pointer text-sm">
                    <input type="checkbox" name="is_new_arrival" value="1" class="accent-gold-600"> New Arrival
                </label>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="btn-gold !py-2 !px-6 text-sm">Save Product</button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 px-4 py-3 rounded-xl mb-6 text-sm">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="card group relative">
                <div
                    class="aspect-square bg-gradient-to-br from-gold-50 to-gold-100 overflow-hidden flex items-center justify-center">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/necklace.png') }}"
                        alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>
                <div class="p-4">
                    <p class="text-xs text-gold-500 uppercase tracking-wider mb-1">{{ $product->category }}</p>
                    <h3 class="font-serif font-semibold text-ink-900 mb-1">{{ $product->name }}</h3>
                    <p class="font-semibold text-ink-900">₹{{ number_format($product->price) }}</p>
                    <div class="grid grid-cols-2 gap-2 mt-4 pt-4 border-t border-gold-50">
                        <a href="{{ url('/admin/products/' . $product->id . '/edit') }}"
                            class="text-xs text-center text-gold-700 bg-gold-50 hover:bg-gold-100 py-2 rounded-lg font-medium transition">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <form method="POST" action="{{ url('/admin/products/' . $product->id . '/delete') }}" onsubmit="return confirm('Delete this product?')" class="block">
                            @csrf
                            <button type="submit" class="w-full text-xs text-center text-red-600 bg-red-50 hover:bg-red-100 py-2 rounded-lg font-medium transition">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-ink-900/50 col-span-4 text-center py-12">No products yet. Click "+ Add Product" to get started.</p>
        @endforelse
    </div>
@endsection