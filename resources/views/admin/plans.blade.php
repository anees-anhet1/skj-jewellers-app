@extends('layouts.admin')
@section('page-title', 'Saving Plans')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="font-serif font-semibold">Active Schemes</h2>
        <button onclick="document.getElementById('addPlanModal').classList.toggle('hidden')"
            class="btn-gold !py-2 !px-5 text-sm">+ Add Plan</button>
    </div>

    {{-- Add Plan Form --}}
    <div id="addPlanModal" class="hidden card p-6 mb-6">
        <form action="{{ url('/admin/plans') }}" method="POST" class="grid md:grid-cols-2 gap-4">
            @csrf
            <input type="text" name="name" placeholder="Plan Name (e.g. Swarna 11-Month Plan)" required
                class="px-4 py-3 rounded-xl border border-gold-100">
            <input type="number" name="duration_months" placeholder="Duration in Months (e.g. 11)" required
                class="px-4 py-3 rounded-xl border border-gold-100">
            <input type="number" name="minimum_amount" step="0.01" placeholder="Minimum Installment Amount (e.g. 1000)"
                required class="px-4 py-3 rounded-xl border border-gold-100 md:col-span-2">
            <textarea name="short_description" placeholder="Short description of benefits" required
                class="px-4 py-3 rounded-xl border border-gold-100 md:col-span-2"></textarea>

            <div class="md:col-span-2">
                <button type="submit" class="btn-gold !py-2 !px-6 text-sm">Save Plan</button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 px-4 py-3 rounded-xl mb-6 text-sm">{{ session('success') }}</div>
    @endif

    <div class="grid md:grid-cols-3 gap-6">
        @forelse($plans as $plan)
            <div class="card p-6">
                <h3 class="font-serif font-semibold text-lg mb-1">{{ $plan->name }}</h3>
                <p class="text-sm text-ink-900/60 mb-4">{{ $plan->short_description }}</p>
                <div class="space-y-2 mb-4 text-sm">
                    <div class="flex justify-between"><span class="text-ink-900/50">Duration</span> <span
                            class="font-medium">{{ $plan->duration_months }} Months</span></div>
                    <div class="flex justify-between"><span class="text-ink-900/50">Min. Installment</span> <span
                            class="font-medium">₹{{ number_format($plan->minimum_amount) }}</span></div>
                </div>
                <div class="flex gap-2 border-t border-gold-100 pt-4">
                    <a href="{{ url('/admin/plans/' . $plan->id . '/delete') }}" onclick="return confirm('Delete this plan?')"
                        class="text-xs text-red-500 hover:underline">Delete Plan</a>
                </div>
            </div>
        @empty
            <p class="text-ink-900/50 col-span-3 py-8 text-center">No plans added yet.</p>
        @endforelse
    </div>
@endsection