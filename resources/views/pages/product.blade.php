@extends('layouts.app')
@section('title', $product->name . ' · ' . config('brand.name'))
@section('content')
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-12 grid md:grid-cols-2 gap-12">
        <div>
            <div
                class="aspect-square rounded-3xl bg-gradient-to-br from-gold-50 to-gold-100 flex items-center justify-center mb-4 overflow-hidden relative group">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    <img src="{{ asset('images/necklace.png') }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-60">
                @endif
            </div>

            <!-- Thumbnail gallery removed since there is only one product image -->
        </div>

        <div>
            <p class="section-subtitle uppercase tracking-widest">{{ $product->category }}</p>
            <h1 class="text-3xl md:text-4xl font-serif font-bold mb-3 text-ink-900">{{ $product->name }}</h1>

            <div class="flex items-center gap-4 mb-6">
                <span class="text-3xl font-semibold text-ink-900">₹{{ number_format((float) $product->price, 2) }}</span>
                @if($product->is_featured)
                    <span
                        class="text-xs font-semibold bg-gold-100 text-gold-700 px-3 py-1 rounded-full uppercase tracking-widest">Featured</span>
                @endif
            </div>

            <p class="text-sm text-ink-900/50 mb-8 border-b border-gold-100 pb-6">MRP inclusive of all taxes. Free shipping
                on all orders.</p>

            <div class="flex flex-col sm:flex-row gap-4 mb-8">
                <a href="{{ url('/book-appointment') }}"
                    class="btn-gold flex-1 text-center py-3 text-sm tracking-wider">Book Showroom Visit</a>
                @auth
                    <form action="{{ url('/wishlist/toggle') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        @php
                            $inWishlist = \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
                        @endphp

                        <button type="submit" class="btn-ink !py-3 px-8 {{ $inWishlist ? 'text-red-500' : '' }}">
                            {{ $inWishlist ? '♥ Remove from Wishlist' : '♡ Add to Wishlist' }}
                        </button>
                    </form>
                @else
                    <a href="{{ url('/login') }}" class="btn-ink !py-3 px-8 text-center">
                        ♡ Login to Wishlist
                    </a>
                @endauth

            </div>

            <div class="bg-gold-50/50 rounded-2xl p-6 border border-gold-100">
                <h3 class="font-serif font-semibold mb-3 text-ink-900">Product Details</h3>
                <p class="text-sm text-ink-900/70 leading-relaxed">
                    {{ $product->description ?? 'Exquisitely crafted with meticulous attention to detail, this piece blends traditional artistry with contemporary design — a timeless addition to your jewellery collection.' }}
                </p>
            </div>
        </div>
    </div>
@endsection