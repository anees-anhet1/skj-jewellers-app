@extends('layouts.app')
@section('title', 'About Us · '.config('brand.name'))
@section('content')
<div class="max-w-5xl mx-auto px-4 md:px-8 py-16">
    <x-section-heading eyebrow="Our Story" :title="'About '.config('brand.name')" center />
    <p class="text-ink-900/60 leading-relaxed text-center max-w-3xl mx-auto mb-16">For us, jewellery is more than just business. We establish and enhance customer relationships because we understand the intense level of involvement that goes into buying jewellery. Rooted in tradition, driven by craftsmanship.</p>
    <div class="grid md:grid-cols-3 gap-8 text-center">
        @foreach([['40+','Years of Trust'],['1','Showroom in Chickpet, Bengaluru'],['5L+','Happy Customers']] as [$n,$l])
        <div class="card p-8">
            <p class="text-3xl font-serif font-bold text-gold-500 mb-2">{{ $n }}</p>
            <p class="text-sm text-ink-900/60">{{ $l }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
