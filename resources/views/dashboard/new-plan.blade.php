@extends('layouts.dashboard')
@section('page-title', 'Start New Scheme')
@section('content')
    <div class="max-w-2xl">
        <div class="card p-6 md:p-8">
            <h2 class="font-serif text-2xl font-semibold mb-6">Select a Saving Plan</h2>

            @if(session('error'))
                <div class="bg-red-50 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm">{{ session('error') }}</div>
            @endif

            <form action="{{ url('/dashboard/new-plan') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-ink-900 mb-2">Available Plans</label>
                    <div class="grid gap-4">
                        @forelse($plans as $plan)
                            <label
                                class="border border-gold-100 rounded-xl p-4 flex gap-4 cursor-pointer hover:border-gold-300 transition-colors">
                                <input type="radio" name="plan_id" value="{{ $plan->id }}" class="mt-1 accent-gold-500"
                                    required>
                                <div>
                                    <h3 class="font-serif font-semibold text-lg">{{ $plan->name }}</h3>
                                    <p class="text-sm text-ink-900/60 mb-2">{{ $plan->short_description }}</p>
                                    <div class="flex gap-4 text-xs font-medium bg-gold-50 px-3 py-1.5 rounded-lg inline-flex">
                                        <span>Duration: {{ $plan->duration_months }} Months</span>
                                        <span>Min: ₹{{ number_format($plan->minimum_amount) }}</span>
                                    </div>
                                </div>
                            </label>
                        @empty
                            <p class="text-sm text-ink-900/50">No plans available at the moment.</p>
                        @endforelse
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-ink-900 mb-2">Monthly Installment Amount (₹)</label>
                    <input type="number" name="monthly_installment" placeholder="Enter amount..." required
                        class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:border-gold-300 focus:ring-0">
                    <p class="text-xs text-ink-900/50 mt-2">Amount must be equal to or greater than the plan's minimum
                        installment.</p>
                </div>

                <div class="pt-4 border-t border-gold-100">
                    <label class="flex gap-3 text-sm mb-6">
                        <input type="checkbox" required class="mt-1 accent-gold-500">
                        <span class="text-ink-900/70">I agree to the terms and conditions of the V Anand Jewellery saving
                            scheme.</span>
                    </label>
                    <button type="submit" class="btn-gold w-full text-center">Enroll Now</button>
                </div>
            </form>
        </div>
    </div>
@endsection