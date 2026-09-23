@extends('layouts.app')
@section('title', 'Today\'s Gold Rate · '.config('brand.name'))
@section('content')
<div class="max-w-5xl mx-auto px-4 md:px-8 py-12">
    <x-section-heading eyebrow="Live Rates" title="Today's Gold & Silver Rate" center />

    @if($rate)
    <p class="text-center text-sm text-ink-900/50 mb-8">
        Last updated {{ $rate->created_at->diffForHumans() }} ({{ $rate->created_at->format('d M Y, h:i A') }})
    </p>

    <div class="grid md:grid-cols-2 gap-8 mb-12">
        <div class="rounded-3xl bg-gradient-to-br from-gold-400 to-gold-600 text-white p-8 text-center">
            <p class="uppercase tracking-widest text-xs text-white/70 mb-2">Gold Rate (22K)</p>
            <p class="text-4xl font-serif font-bold">₹{{ number_format($rate->rate_22k, 2) }} <span class="text-base font-normal">/gm</span></p>
        </div>
        <div class="rounded-3xl bg-ink-900 text-white p-8 text-center">
            <p class="uppercase tracking-widest text-xs text-white/50 mb-2">Silver Rate</p>
            <p class="text-4xl font-serif font-bold">₹{{ number_format($rate->rate_silver, 2) }} <span class="text-base font-normal">/gm</span></p>
        </div>
    </div>

    <div class="card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gold-50 text-ink-900/70">
                <tr><th class="text-left p-4">Purity</th><th class="text-left p-4">Rate / gram</th><th class="text-left p-4">Rate / 8 gram</th></tr>
            </thead>
            <tbody>
                @php
                    $rate18k = $rate->rate_24k * 0.75;
                @endphp
                <tr class="border-t border-gold-50">
                    <td class="p-4 font-medium">24K</td>
                    <td class="p-4">₹{{ number_format($rate->rate_24k, 2) }}</td>
                    <td class="p-4">₹{{ number_format($rate->rate_24k * 8, 2) }}</td>
                </tr>
                <tr class="border-t border-gold-50">
                    <td class="p-4 font-medium">22K</td>
                    <td class="p-4">₹{{ number_format($rate->rate_22k, 2) }}</td>
                    <td class="p-4">₹{{ number_format($rate->rate_22k * 8, 2) }}</td>
                </tr>
                <tr class="border-t border-gold-50">
                    <td class="p-4 font-medium">18K</td>
                    <td class="p-4">₹{{ number_format($rate18k, 2) }}</td>
                    <td class="p-4">₹{{ number_format($rate18k * 8, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @else
    <p class="text-center text-ink-900/50">Gold rate has not been published yet. Please check back soon.</p>
    @endif
</div>
@endsection