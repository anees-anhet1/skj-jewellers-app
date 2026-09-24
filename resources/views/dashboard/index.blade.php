@extends('layouts.dashboard')
@section('page-title','Dashboard')
@section('content')
<!-- Today's Gold Rate & Welcome Banner -->
<div class="relative rounded-3xl overflow-hidden mb-8 bg-ink-900 border border-gold-400/30 text-white shadow-2xl">
    <img src="{{ asset('images/dashboard-banner.png') }}" alt="Showroom" class="absolute inset-0 w-full h-full object-cover opacity-25">
    <div class="relative z-10 p-6 md:p-10 flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs uppercase tracking-widest text-gold-400 font-semibold">Today's Live Rate · {{ date('D, d M Y') }}</span>
            </div>
            <h2 class="text-2xl md:text-4xl font-serif font-bold text-white mb-2">Welcome Back, {{ auth()->user()->name ?? 'Customer' }}</h2>
            <p class="text-white/80 text-sm max-w-lg">Track your accumulated gold weight, manage active savings plans, and pay EMIs effortlessly.</p>
        </div>
        @if($latestRate)
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 min-w-[240px]">
            <p class="text-xs text-gold-300 font-semibold mb-1">LIVE GOLD RATE TODAY</p>
            <div class="flex justify-between items-baseline mb-1">
                <span class="text-xs text-white/80">22K Gold (1g)</span>
                <span class="font-serif font-bold text-lg text-gold-400">₹{{ number_format($latestRate->rate_22k, 0) }}</span>
            </div>
            <div class="flex justify-between items-baseline mb-2">
                <span class="text-xs text-white/80">24K Gold (1g)</span>
                <span class="font-serif font-bold text-sm text-white">₹{{ number_format($latestRate->rate_24k, 0) }}</span>
            </div>
            <p class="text-[10px] text-white/60 text-right">Updated {{ $latestRate->created_at->format('d M, h:i A') }}</p>
        </div>
        @else
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 min-w-[240px]">
            <p class="text-xs text-gold-300 font-semibold mb-1">GOLD RATE</p>
            <p class="text-white/60 text-sm">Rate not published yet.</p>
        </div>
        @endif
    </div>
</div>

<div class="grid md:grid-cols-4 gap-6 mb-8">
    <x-stat-card label="Active Plans" value="{{ $activePlans }}" sub="{{ $activePlans > 0 ? 'Manage your plans' : 'No active plans' }}" />
    <x-stat-card label="Total Paid" value="₹{{ number_format($totalPaid) }}" />
    <x-stat-card label="Gold Accumulated" value="{{ $goldWeight }} gm" sub="Pure 22K Gold" />
    <x-stat-card label="Closed Plans" value="{{ $closedPlans }}" />
</div>

<div class="grid md:grid-cols-3 gap-6 mb-8">
    <!-- Accumulated Gold Weight Vault Card -->
    <div class="card p-6 md:col-span-2 flex flex-col sm:flex-row gap-6 items-center bg-gradient-to-br from-gold-50/50 to-white">
        <div class="w-full sm:w-48 aspect-square rounded-2xl overflow-hidden border border-gold-200 shadow-md flex-shrink-0">
            <img src="{{ asset('images/dashboard-vault.png') }}" alt="Gold Vault" class="w-full h-full object-cover">
        </div>
        <div>
            <span class="text-xs text-gold-600 font-semibold tracking-widest uppercase mb-1 block">Accumulated Holdings</span>
            <h3 class="font-serif text-2xl font-bold text-ink-900 mb-2">Your Gold Vault: {{ $goldWeight }} Grams</h3>
            <p class="text-sm text-ink-900/60 mb-4">Your monthly scheme instalments are automatically converted into 22K gold weight based on today's live rate.</p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ url('/dashboard/gold-weight') }}" class="btn-gold !px-5 !py-2 text-xs">View Weight Breakdown</a>
                <a href="{{ url('/dashboard/my-plans') }}" class="btn-outline !px-5 !py-2 text-xs">Add Gold Weight</a>
            </div>
        </div>
    </div>

    <!-- Today's Rate Breakdown Card -->
    <div class="card p-6 bg-ink-900 text-white flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-serif font-semibold text-lg text-gold-400">Daily Gold Rate</h3>
                <span class="text-[10px] bg-gold-500/20 text-gold-400 px-2 py-0.5 rounded-full uppercase tracking-wider">Live</span>
            </div>
            @if($latestRate)
            <div class="space-y-3 mb-6 text-sm">
                <div class="flex justify-between pb-2 border-b border-white/10">
                    <span class="text-white/70">22K Gold (8g / 1 Pavan)</span>
                    <span class="font-bold text-gold-400">₹{{ number_format($latestRate->rate_22k * 8, 0) }}</span>
                </div>
                <div class="flex justify-between pb-2 border-b border-white/10">
                    <span class="text-white/70">24K Pure Gold (10g)</span>
                    <span class="font-bold text-white">₹{{ number_format($latestRate->rate_24k * 10, 0) }}</span>
                </div>
                <div class="flex justify-between pb-2 border-b border-white/10">
                    <span class="text-white/70">Silver (1g)</span>
                    <span class="font-bold text-white">₹{{ number_format($latestRate->rate_silver, 2) }}</span>
                </div>
            </div>
            @else
            <p class="text-white/60 text-sm mb-6">Gold rate has not been published yet.</p>
            @endif
        </div>
        <p class="text-xs text-white/60">Rates update daily when admin publishes new rates.</p>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6">
    <div class="card p-6 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-serif font-semibold">Active Plan Details</h3>
                <a href="{{ url('/dashboard/my-plans') }}" class="text-gold-500 text-sm">View all →</a>
            </div>
            @if($latestPlan)
            <div class="p-4 rounded-xl bg-gold-50 border border-gold-100 flex items-center gap-4">
                <img src="{{ asset('images/dashboard-scheme.png') }}" alt="Scheme" class="w-16 h-16 rounded-xl object-cover border border-gold-300">
                <div class="flex-1">
                    <p class="font-semibold text-sm">{{ $latestPlan->plan->name ?? 'Gold Savings Scheme' }}</p>
                    <div class="grid grid-cols-3 text-xs text-ink-900/60 gap-2 mt-1">
                        <div><p class="text-ink-900/40">ID</p><p class="font-medium text-ink-900">{{ $latestPlan->id }}</p></div>
                        <div><p class="text-ink-900/40">Installment</p><p class="font-medium text-ink-900">₹{{ number_format($latestPlan->monthly_installment) }}</p></div>
                        <div><p class="text-ink-900/40">Paid</p><p class="font-medium text-ink-900">{{ $latestPlan->installments_paid }}/{{ $latestPlan->plan->duration_months ?? '?' }}</p></div>
                    </div>
                </div>
            </div>
            @else
            <div class="p-4 rounded-xl bg-gold-50 border border-gold-100 text-center">
                <p class="text-sm text-ink-900/50">No active plans. <a href="{{ url('/dashboard/new-plan') }}" class="text-gold-600 font-medium hover:underline">Join one now →</a></p>
            </div>
            @endif
        </div>
    </div>
    <div class="card p-6">
        <h3 class="font-serif font-semibold mb-4">Quick Dashboard Actions</h3>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <a href="{{ url('/dashboard/my-plans') }}" class="btn-gold justify-center">Pay EMIs</a>
            <a href="{{ url('/dashboard/new-plan') }}" class="btn-outline justify-center">Join New Plan</a>
            <a href="{{ url('/dashboard/payment-history') }}" class="btn-outline justify-center">Payment History</a>
            <a href="{{ url('/dashboard/gold-weight') }}" class="btn-outline justify-center">Gold Weight Vault</a>
        </div>
    </div>
</div>

@if($latestRate)
<section class="mt-10 pt-8 border-t-2 border-gold-200" id="v-anand-todays-rate">
    <p class="text-xs uppercase tracking-widest text-gold-600 font-semibold mb-3">Live bullion rates</p>
    <x-todays-rate-widget :gold22k="number_format($latestRate->rate_22k, 2)" :silver="number_format($latestRate->rate_silver, 2)" class="w-full max-w-2xl" />
</section>
@endif
@endsection
