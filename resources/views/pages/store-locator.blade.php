@extends('layouts.app')
@section('title', 'Store Locator · '.config('brand.name'))
@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <x-section-heading eyebrow="Visit" title="Our Store" />
    <p class="text-ink-900/60 text-center max-w-2xl mx-auto mb-10 -mt-4">Visit us at our showroom in Chickpet, Bengaluru.</p>
    <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-1 space-y-4">
            @foreach(config('brand.stores') as $store)
            <div class="card p-6 border-l-4 border-gold-500 hover:shadow-lg transition-shadow duration-300">
                <h3 class="font-serif font-bold text-lg mb-4 text-ink-900">{{ config('brand.name') }} – {{ $store['area'] }}, {{ $store['city'] }}</h3>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gold-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <p class="text-sm text-ink-900/70">{{ $store['address'] }}</p>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <p class="text-sm text-ink-900/70 font-medium">{{ config('brand.phone') }}</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gold-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <p class="text-sm text-ink-900/70">Mon – Sat: 10:00 AM – 8:00 PM</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="https://maps.google.com/?q=Chickpet,+Bengaluru" target="_blank" class="btn-gold flex-1 text-center py-2.5 text-sm">Get Directions</a>
                    <a href="tel:{{ str_replace(' ', '', config('brand.phone')) }}" class="btn-outline flex-1 text-center py-2.5 text-sm">Call Now</a>
                </div>
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
