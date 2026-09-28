@extends('layouts.app')
@section('title', 'Store Locator · '.config('brand.name'))
@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <x-section-heading eyebrow="Visit" title="Our Store" />
    <p class="text-ink-900/60 text-center max-w-2xl mx-auto mb-10 -mt-4">Visit us at our showroom in Chickpet, Bengaluru.</p>
    <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-1 space-y-4">
            @foreach(config('brand.stores') as $store)
            <div class="card p-5">
                <h3 class="font-serif font-semibold mb-1">{{ config('brand.name') }} – {{ $store['area'] }}, {{ $store['city'] }}</h3>
                <p class="text-sm text-ink-900/60 mb-2">{{ $store['address'] }}</p>
                <p class="text-sm text-gold-500 font-medium">{{ config('brand.phone') }}</p>
            </div>
            @endforeach
        </div>
        <div class="md:col-span-2 rounded-3xl bg-gold-50 border border-gold-100 overflow-hidden relative min-h-[420px]">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.0837583625475!2d77.57529431482187!3d12.96649799085871!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae16075904fc49%3A0x671168051a8af3c3!2sChickpet%2C%20Bengaluru%2C%20Karnataka!5e0!3m2!1sen!2sin!4v1689255000000!5m2!1sen!2sin" 
                class="absolute inset-0 w-full h-full border-0" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>
@endsection
