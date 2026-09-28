@extends('layouts.app')
@section('title', config('brand.name').' · Timeless Elegance')
@section('content')

<section class="relative bg-gradient-to-br from-gold-50 via-white to-gold-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-16 md:py-24 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <p class="section-subtitle">Est. Trust · Generations of Craft</p>
            <h1 class="text-4xl md:text-6xl font-serif font-bold text-ink-900 leading-tight mb-6">Jewellery that <span class="text-gold-500">tells your story</span></h1>
            <p class="text-ink-900/60 mb-8 max-w-md">Discover handcrafted 22k gold, diamond and platinum jewellery, and secure your future with our trusted Gold Savings Schemes.</p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ url('/shop') }}" class="btn-gold">Shop Collection</a>
                <a href="{{ url('/gold-saving-scheme') }}" class="btn-outline">Explore Gold Savings</a>
            </div>
        </div>
        <div class="relative">
            <div class="aspect-square rounded-full bg-gradient-to-br from-gold-200 to-gold-400 opacity-30 blur-3xl absolute inset-0"></div>
            <div class="relative aspect-[4/3] rounded-3xl bg-white shadow-luxe border border-gold-100 overflow-hidden">
                <img src="{{ asset('images/hero-jewellery.png') }}" alt="{{ config('brand.name') }} Royal Gold Collection" class="w-full h-full object-cover">
            </div>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 md:px-8 py-20">
    <x-section-heading eyebrow="Curated For You" title="Explore Our Collections" center />
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($collections as $col)
        <a href="{{ url('/shop?collection_id=' . $col->id) }}" class="group text-center">
            <div class="aspect-square rounded-2xl bg-gold-50 group-hover:bg-gold-100 flex items-center justify-center mb-3 transition overflow-hidden border border-gold-100 shadow-sm">
                @if($col->image)
                    <img src="{{ asset('storage/' . $col->image) }}" alt="{{ $col->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gold-300"><i class="bi bi-images text-4xl"></i></div>
                @endif
            </div>
            <p class="font-medium text-sm text-ink-900 group-hover:text-gold-600 transition">{{ $col->name }}</p>
        </a>
        @empty
            <p class="text-ink-900/50 col-span-full text-center py-8">More collections coming soon.</p>
        @endforelse
    </div>
</section>

<section class="bg-ink-900 py-20">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <x-section-heading eyebrow="New Arrivals" title="Handpicked For You" center />
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($newArrivals as $product)
                <a href="{{ url('/product/'.$product->id) }}" class="block">
                    <x-product-card 
                        :name="$product->name" 
                        :price="$product->price" 
                        :image="$product->image"
                        :tag="$product->is_featured ? 'Featured' : 'New'"
                    >
                        {{ $product->category }}
                    </x-product-card>
                </a>
            @empty
                <p class="text-white/60 col-span-4 text-center">No new arrivals available right now.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 md:px-8 py-20 grid md:grid-cols-3 gap-8">
    @foreach([
        ['Pay From Anywhere', 'Make your gold scheme payments from any corner of the world, anytime online.'],
        ['Live Rate Assurance', 'Stay informed with live, transparent 22K & 24K gold rates daily.'],
        ['Trusted Since Generations', 'Decades of craftsmanship, 100% BIS Hallmarked purity and customer trust.'],
    ] as [$t,$d])
    <div class="card p-8 text-center hover:border-gold-400 transition">
        <div class="w-14 h-14 mx-auto rounded-full bg-gold-100 flex items-center justify-center mb-4 text-gold-600 font-bold text-xl">
            <i class="bi bi-shield-check"></i>
        </div>
        <h3 class="font-serif font-semibold text-lg mb-2">{{ $t }}</h3>
        <p class="text-sm text-ink-900/60">{{ $d }}</p>
    </div>
    @endforeach
</section>

<section class="max-w-7xl mx-auto px-4 md:px-8 pb-20">
    <div class="rounded-3xl bg-gradient-to-r from-gold-900 via-ink-900 to-gold-800 p-8 md:p-12 text-white flex flex-col md:flex-row items-center justify-between gap-8 border border-gold-400/30 shadow-2xl">
        <div class="flex items-center gap-6">
            <img src="{{ asset('images/gold-coins.png') }}" alt="Gold Savings Scheme" class="w-28 h-28 object-cover rounded-2xl border-2 border-gold-400 shadow-lg hidden sm:block">
            <div>
                <span class="text-gold-400 text-xs font-semibold uppercase tracking-widest">Smart Gold Investment</span>
                <h2 class="text-2xl md:text-3xl font-serif font-bold mb-2">Start your Gold Savings Journey today</h2>
                <p class="text-white/80 max-w-xl text-sm">Join Swarna Dharaa or Chutti Lathika schemes and accumulate 22K gold & coins with zero making charges.</p>
            </div>
        </div>
        <a href="{{ url('/gold-saving-scheme') }}" class="btn-gold !px-8 !py-4 whitespace-nowrap shadow-luxe">Join Gold Scheme</a>
    </div>
</section>

@endsection
