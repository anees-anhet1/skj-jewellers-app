@extends('layouts.app')
@section('title', 'Offers · '.config('brand.name'))
@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <div class="rounded-3xl bg-gradient-to-r from-gold-500 to-gold-700 text-white p-10 mb-12">
        <p class="text-sm tracking-widest uppercase mb-2 text-white/70">Limited Time</p>
        <h1 class="text-4xl font-serif font-bold mb-2">Get up to 25% off on Making Charges</h1>
        <p class="text-white/80">On select gold and diamond jewellery collections</p>
    </div>

    <x-section-heading eyebrow="Offers" title="Current Offers" />
    <div class="grid md:grid-cols-2 gap-6 mb-12">
        @forelse($offers as $offer)
        <div class="card p-6 flex justify-between items-center">
            <div>
                <p class="font-medium">{{ $offer->title }}</p>
                <p class="text-sm text-ink-900/50">Valid till {{ \Carbon\Carbon::parse($offer->valid_till)->format('d M Y') }}</p>
            </div>
            <span class="text-gold-600 font-bold text-lg">{{ $offer->discount }}% OFF</span>
        </div>
        @empty
        <p class="text-ink-900/50">No active offers right now. Check back soon!</p>
        @endforelse
    </div>

    <x-section-heading eyebrow="Offers" title="Offer Products" />
    <div class="flex gap-2 mb-8 text-xs">
        @foreach(['All','Gold','Silver','Diamond','Platinum'] as $c)
        <button class="px-4 py-2 rounded-full border border-gold-200">{{ $c }}</button>
        @endforeach
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($offerProducts as $product)
        <a href="{{ url('/product/'.$product->id) }}" class="block">
            <x-product-card 
                :name="$product->name" 
                :price="$product->price" 
                :image="$product->image"
                tag="Sale"
            >
                {{ $product->category }}
            </x-product-card>
        </a>
        @empty
        <div class="col-span-2 lg:col-span-4 text-center py-12 text-ink-900/50 bg-gold-50/30 rounded-3xl border border-gold-100">
            No products currently on sale.
        </div>
        @endforelse
    </div>
</div>
@endsection