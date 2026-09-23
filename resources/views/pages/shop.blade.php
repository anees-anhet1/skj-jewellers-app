@extends('layouts.app')
@section('title', 'Shop Jewellery · '.config('brand.name'))
@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <x-section-heading eyebrow="Shop" title="Shop Jewellery" />
    <div class="grid md:grid-cols-4 gap-8">
        <aside class="md:col-span-1 space-y-8">
            <div>
                <h4 class="font-serif font-semibold mb-3">Category</h4>
                <div class="space-y-2 text-sm text-ink-900/70">
                    @foreach(['All','Gold','Silver','Diamond','Platinum'] as $c)
                    <label class="flex items-center gap-2"><input type="checkbox" class="accent-gold-400"> {{ $c }}</label>
                    @endforeach
                </div>
            </div>
            <div>
                <h4 class="font-serif font-semibold mb-3">Price Range</h4>
                <input type="range" class="w-full accent-gold-400">
            </div>
        </aside>
        <div class="md:col-span-3">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <input type="text" placeholder="Search 'Rings'" class="px-4 py-2 rounded-full border border-gold-100 text-sm w-full max-w-xs focus:outline-none focus:ring-2 focus:ring-gold-300">
                <div class="flex gap-2 text-xs">
                    <button class="px-4 py-2 rounded-full border border-gold-200">Sort</button>
                    <button class="px-4 py-2 rounded-full border border-gold-200">Filter</button>
                </div>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-6">
                @for($i=0;$i<9;$i++)
                <a href="{{ url('/product/'.($i+1)) }}"><x-product-card /></a>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection
