@extends('layouts.admin')
@section('page-title','Edit Product')
@section('content')
<div class="card p-6 max-w-2xl">
    <form action="{{ url('/admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $product->name }}" placeholder="Product Name" required class="px-4 py-3 rounded-xl border border-gold-100">
        <select name="category" required class="px-4 py-3 rounded-xl border border-gold-100">
            <option value="">Select Category</option>
            <option {{ $product->category == 'Gold' ? 'selected' : '' }}>Gold</option>
            <option {{ $product->category == 'Silver' ? 'selected' : '' }}>Silver</option>
            <option {{ $product->category == 'Diamond' ? 'selected' : '' }}>Diamond</option>
            <option {{ $product->category == 'Platinum' ? 'selected' : '' }}>Platinum</option>
        </select>
        <select name="collection_id" class="px-4 py-3 rounded-xl border border-gold-100">
            <option value="">No Collection</option>
            @foreach($collections as $collection)
                <option value="{{ $collection->id }}" {{ $product->collection_id == $collection->id ? 'selected' : '' }}>{{ $collection->name }}</option>
            @endforeach
        </select>
        <input type="number" name="price" step="0.01" value="{{ $product->price }}" placeholder="Price" required class="px-4 py-3 rounded-xl border border-gold-100">
        <input type="text" name="weight" value="{{ $product->weight }}" placeholder="Weight (e.g. 10g)" class="px-4 py-3 rounded-xl border border-gold-100">
        <textarea name="description" placeholder="Description" class="px-4 py-3 rounded-xl border border-gold-100 md:col-span-2">{{ $product->description }}</textarea>
        
        <div class="md:col-span-2">
            <p class="text-sm mb-2">Current Image:</p>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="w-24 h-24 object-cover rounded-xl mb-3">
            @else
                <p class="text-sm text-ink-900/50 mb-3">No image uploaded</p>
            @endif
            <input type="file" name="image" accept="image/*" class="px-4 py-3 rounded-xl border border-gold-100 w-full">
        </div>
        
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }}> <label class="text-sm">Featured</label>
        </div>
        <div class="md:col-span-2 flex gap-3 mt-4">
            <button type="submit" class="btn-gold !py-2 !px-6 text-sm">Update Product</button>
            <a href="{{ url('/admin/products') }}" class="btn-outline !py-2 !px-6 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection
