@extends('layouts.dashboard')
@section('page-title','Closed Plans')
@section('content')

@if(session('success'))
    <div class="bg-green-50 text-green-600 px-4 py-3 rounded-xl mb-6 text-sm">{{ session('success') }}</div>
@endif

<x-stat-card label="Total Closed Accounts" value="{{ str_pad($userPlans->count(), 2, '0', STR_PAD_LEFT) }}" />

<div class="grid md:grid-cols-2 gap-6 mt-6">
    @forelse($userPlans as $up)
    <div class="card p-5">
        <div class="flex justify-between items-start mb-3">
            <div>
                <p class="font-serif font-semibold">{{ $up->plan->name }}</p>
                <p class="text-xs text-gold-500 text-transform uppercase mt-1">{{ $up->status }}</p>
            </div>
            <span class="text-xs text-ink-900/40">Plan ID: {{ $up->id }}</span>
        </div>
        <div class="grid grid-cols-3 gap-3 text-xs">
            <div><p class="text-ink-900/40">Joined</p><p class="font-medium">{{ \Carbon\Carbon::parse($up->start_date)->format('d M Y') }}</p></div>
            <div><p class="text-ink-900/40">Maturity</p><p class="font-medium">{{ \Carbon\Carbon::parse($up->maturity_date)->format('d M Y') }}</p></div>
            <div><p class="text-ink-900/40">Installments</p><p class="font-medium">{{ $up->installments_paid }}/{{ $up->plan->duration_months }}</p></div>
        </div>
        <div class="mt-4 pt-4 border-t border-ink-200">
            <p class="text-xs text-ink-900/40 mb-1">Total Paid</p>
            <p class="font-semibold text-lg">₹{{ number_format($up->total_paid) }}</p>
        </div>
    </div>
    @empty
    <div class="col-span-2 text-center py-12 card">
        <h3 class="font-serif text-xl font-semibold mb-2">No Closed Plans</h3>
        <p class="text-ink-900/60">You do not have any closed or cancelled plans.</p>
    </div>
    @endforelse
</div>
@endsection
