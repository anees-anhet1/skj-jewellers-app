@extends('layouts.app')
@section('title', 'Gold Premium Necklace · '.config('brand.name'))
@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-12 grid md:grid-cols-2 gap-12">
    <div>
        <div class="aspect-square rounded-3xl bg-gradient-to-br from-gold-50 to-gold-100 flex items-center justify-center mb-4">
            <div class="w-40 h-40 rounded-full border-8 border-gold-300"></div>
        </div>
        <div class="grid grid-cols-4 gap-3">
            @for($i=0;$i<4;$i++)
            <div class="aspect-square rounded-xl bg-gold-50 border border-gold-100"></div>
            @endfor
        </div>
    </div>
    <div>
        <p class="section-subtitle">Necklace</p>
        <h1 class="text-3xl font-serif font-bold mb-2">Gold Premium Necklace</h1>
        <div class="flex items-center gap-3 mb-6">
            <span class="text-2xl font-semibold text-ink-900">₹62,000</span>
            <span class="text-ink-900/40 line-through">₹72,000</span>
            <span class="text-sm text-green-600 font-medium">14% off</span>
        </div>
        <p class="text-sm text-ink-900/50 mb-6">MRP inclusive of all taxes</p>
        <div class="flex gap-4 mb-8">
            <a href="{{ url('/book-appointment') }}" class="btn-gold">Enquire Now</a>
            <button class="btn-outline">♥ Wishlist</button>
        </div>
        <div class="border-t border-gold-100 pt-6">
            <h3 class="font-serif font-semibold mb-2">About the Product</h3>
            <p class="text-sm text-ink-900/60 leading-relaxed">Exquisitely crafted with meticulous attention to detail, this piece blends traditional artistry with contemporary design — a timeless addition to your jewellery collection.</p>
        </div>
    </div>
</div>
@endsection
