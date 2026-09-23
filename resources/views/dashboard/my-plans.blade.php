@extends('layouts.dashboard')
@section('page-title', 'My Active Plans')
@section('content')

    @if(session('success'))
        <div class="bg-green-50 text-green-600 px-4 py-3 rounded-xl mb-6 text-sm">{{ session('success') }}</div>
    @endif

    <div class="grid md:grid-cols-2 gap-6">
        @forelse($userPlans as $up)
            <div class="card p-6 border-l-4 border-gold-400">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span
                            class="px-2.5 py-1 bg-gold-100 text-gold-700 rounded-lg text-xs font-semibold mb-2 inline-block uppercase tracking-wide">{{ $up->status }}</span>
                        <h3 class="font-serif text-xl font-bold">{{ $up->plan->name }}</h3>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-ink-900/50 uppercase tracking-wider mb-1">Monthly</p>
                        <p class="font-semibold text-lg">₹{{ number_format($up->monthly_installment) }}</p>
                    </div>
                </div>

                <div class="bg-gold-50 rounded-xl p-4 mb-4 grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-ink-900/50 mb-1">Total Paid</p>
                        <p class="font-semibold">₹{{ number_format($up->total_paid) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-ink-900/50 mb-1">Installments</p>
                        <p class="font-semibold">{{ $up->installments_paid }} / {{ $up->plan->duration_months }}</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <form action="{{ url('/dashboard/my-plans/' . $up->id . '/pay') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full btn-gold !py-2.5 text-sm">Pay EMI</button>
                    </form>

                    <form action="{{ url('/dashboard/my-plans/'.$up->id.'/close') }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to close this plan?');">
                        @csrf
                        <button type="submit" class="w-full border border-red-500 text-red-600 rounded-xl px-4 py-2.5 text-sm font-medium hover:bg-red-50 transition-colors">Close</button>
                    </form>

                    <a href="{{ url('/dashboard/my-plans/' . $up->id) }}"
                        class="btn-outline flex-1 text-center !py-2.5 text-sm">View Details</a>
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center py-12 card">
                <div
                    class="w-16 h-16 bg-gold-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gold-400 text-2xl">
                    💍</div>
                <h3 class="font-serif text-xl font-semibold mb-2">No Active Plans</h3>
                <p class="text-ink-900/60 mb-6">You haven't enrolled in any saving schemes yet.</p>
                <a href="{{ url('/dashboard/new-plan') }}" class="btn-gold inline-block">Explore Plans</a>
            </div>
        @endforelse
    </div>
@endsection