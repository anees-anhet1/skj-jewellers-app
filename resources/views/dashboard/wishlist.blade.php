@extends('layouts.dashboard')
@section('title', 'My Wishlist')
@section('content')

<h2 class="font-serif text-2xl font-semibold mb-6">My Wishlist</h2>

@if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 px-4 py-3 rounded-xl mb-6 text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-2 md:grid-cols-3 gap-6">
    @forelse($wishlists as $item)
        <div class="relative group">
            <a href="{{ url('/product/'.$item->product->id) }}" class="block">
                <x-product-card 
                    :name="$item->product->name" 
                    :price="$item->product->price" 
                    :image="$item->product->image"
                    tag="Saved"
                >
                    {{ $item->product->category }}
                </x-product-card>
            </a>
            
            <!-- Quick Remove Button overlay -->
            <form action="{{ url('/wishlist/toggle') }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                @csrf
                <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                <button type="submit" class="w-8 h-8 rounded-full bg-white text-red-500 shadow-md flex items-center justify-center hover:bg-red-50">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </div>
    @empty
        <div class="col-span-full py-12 text-center text-ink-900/50 bg-white rounded-3xl border border-gold-100">
            <p>Your wishlist is empty.</p>
            <a href="{{ url('/shop') }}" class="text-gold-600 font-medium hover:underline mt-2 inline-block">Browse Jewellery</a>
        </div>
    @endforelse
</div>

@endsection
