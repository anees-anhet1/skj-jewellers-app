@extends('layouts.app')
@section('title', 'Gold Savings Scheme · '.config('brand.name'))
@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <x-section-heading eyebrow="Save Smart" title="Gold Savings Scheme" center />
    
    <div class="flex flex-wrap justify-center gap-8 mb-16">
        @forelse($plans as $plan)
        <div class="card p-8 border-2 border-transparent hover:border-gold-300 transition-colors duration-300 relative overflow-hidden group w-full sm:w-[360px] text-left">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gold-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
            <h3 class="font-serif text-2xl font-bold text-ink-900 mb-2">{{ $plan->name }}</h3>
            <p class="text-ink-900/60 mb-6 line-clamp-2">{{ $plan->short_description }}</p>
            <div class="space-y-3 mb-8">
                <div class="flex justify-between items-center pb-3 border-b border-gold-100/50">
                    <span class="text-ink-900/60">Duration</span>
                    <span class="font-semibold text-ink-900">{{ $plan->duration_months }} Months</span>
                </div>
                <div class="flex justify-between items-center pb-3 border-b border-gold-100/50">
                    <span class="text-ink-900/60">Min. Installment</span>
                    <span class="font-semibold text-ink-900">₹{{ number_format($plan->minimum_amount) }}</span>
                </div>
            </div>
            <a href="{{ url('/dashboard/new-plan') }}" class="btn-gold w-full text-center block">Start Saving Now</a>
        </div>
        @empty
        <p class="text-center col-span-3 text-ink-900/50 py-12">No saving plans are currently available.</p>
        @endforelse
    </div>

    <x-section-heading eyebrow="How it works" title="Process to Join" center />
    <div class="grid md:grid-cols-3 gap-8">
        @foreach(['Click Join Now','Select Plan','Make First Payment'] as $i => $step)
        <div class="text-center">
            <div class="w-16 h-16 mx-auto rounded-full bg-gold-50 flex items-center justify-center font-serif font-bold text-gold-500 text-xl mb-4">{{ $i+1 }}</div>
            <p class="font-medium">{{ $step }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection