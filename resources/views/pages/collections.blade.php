@extends('layouts.app')
@section('title', 'Collections · '.config('brand.name'))
@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <x-section-heading eyebrow="Curated" title="Our Collections" />
    <div class="grid md:grid-cols-3 gap-8">
        @foreach(['Bridal Radiance','Muhurtham Jewellery','Temple Collection','Diamond Elegance','Antique Gold','Everyday Fine'] as $c)
        <div class="card">
            <div class="aspect-[4/3] bg-gradient-to-br from-gold-100 to-gold-300"></div>
            <div class="p-6">
                <h3 class="font-serif font-semibold text-lg mb-1">{{ $c }}</h3>
                <p class="text-sm text-ink-900/60 mb-4">A season of glittering discounts and handcrafted designs.</p>
                <a href="{{ url('/shop') }}" class="text-gold-500 text-sm font-semibold">View Collection →</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
