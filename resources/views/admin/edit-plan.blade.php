@extends('layouts.admin')
@section('page-title', 'Edit Plan')
@section('content')

@if(session('success'))
    <div class="bg-green-50 text-green-600 px-4 py-3 rounded-xl mb-6 text-sm">{{ session('success') }}</div>
@endif

<div class="max-w-2xl">
    <div class="card p-8">
        <h3 class="font-serif font-semibold text-xl mb-6">Edit Plan</h3>
        <form action="{{ url('/admin/plans/' . $plan->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Plan Name</label>
                <input type="text" name="name" value="{{ $plan->name }}" required class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:outline-none focus:ring-2 focus:ring-gold-300">
            </div>
            <div class="grid md:grid-cols-2 gap-5">
                <div class="space-y-2">
                    <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Duration (Months)</label>
                    <input type="number" name="duration_months" value="{{ $plan->duration_months }}" required class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:outline-none focus:ring-2 focus:ring-gold-300">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Minimum Installment (₹)</label>
                    <input type="number" name="minimum_amount" step="0.01" value="{{ $plan->minimum_amount }}" required class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:outline-none focus:ring-2 focus:ring-gold-300">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Description</label>
                <textarea name="short_description" rows="3" required class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:outline-none focus:ring-2 focus:ring-gold-300">{{ $plan->short_description }}</textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-gold !py-2.5 !px-8 text-sm">Update Plan</button>
                <a href="{{ url('/admin/plans') }}" class="px-6 py-2.5 rounded-full border border-ink-900/10 text-sm hover:bg-ink-900/5 transition">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
