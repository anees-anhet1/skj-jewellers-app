@extends('layouts.dashboard')
@section('dashboard-title', 'Plan Details')
@section('content')

    <div class="mb-6">
        <a href="{{ url('/dashboard/my-plans') }}" class="text-gold-600 text-sm hover:underline">← Back to My Plans</a>
    </div>

    <div class="card p-6 md:p-8 max-w-3xl">
        <div class="flex justify-between items-start mb-6 pb-6 border-b border-gold-100">
            <div>
                <span
                    class="px-3 py-1 bg-gold-100 text-gold-700 rounded-lg text-xs font-semibold mb-3 inline-block uppercase">{{ $userPlan->status }}</span>
                <h2 class="font-serif text-3xl font-bold mb-1">{{ $userPlan->plan->name }}</h2>
                <p class="text-ink-900/60 text-sm">Started on:
                    {{ \Carbon\Carbon::parse($userPlan->start_date)->format('d M, Y') }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-ink-900/50 uppercase tracking-wider mb-1">Maturity Date</p>
                <p class="font-semibold text-lg">{{ \Carbon\Carbon::parse($userPlan->maturity_date)->format('d M, Y') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-6 mb-8 text-center">
            <div class="bg-gold-50 rounded-xl p-4">
                <p class="text-xs text-ink-900/50 mb-1 uppercase tracking-wide">Monthly Installment</p>
                <p class="font-semibold text-xl">₹{{ number_format($userPlan->monthly_installment) }}</p>
            </div>
            <div class="bg-gold-50 rounded-xl p-4">
                <p class="text-xs text-ink-900/50 mb-1 uppercase tracking-wide">Total Paid</p>
                <p class="font-semibold text-xl text-green-600">₹{{ number_format($userPlan->total_paid) }}</p>
            </div>
            <div class="bg-gold-50 rounded-xl p-4">
                <p class="text-xs text-ink-900/50 mb-1 uppercase tracking-wide">Installments Paid</p>
                <p class="font-semibold text-xl">{{ $userPlan->installments_paid }} / {{ $userPlan->plan->duration_months }}
                </p>
            </div>
        </div>

        <h3 class="font-serif text-xl font-semibold mb-4">Payment History</h3>
                @php
            $payments = App\Models\Payment::where('user_plan_id', $userPlan->id)->latest()->get();
        @endphp

        @if($payments->count() > 0)
        <div class="overflow-x-auto rounded-xl border border-gold-100">
            <table class="w-full text-left text-sm">
                <thead class="bg-gold-50/50 text-ink-900/60 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-4 font-medium">Transaction ID</th>
                        <th class="px-6 py-4 font-medium">Date</th>
                        <th class="px-6 py-4 font-medium text-right">Amount Paid</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gold-100">
                    @foreach($payments as $payment)
                    <tr class="hover:bg-gold-50/30 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs">{{ $payment->transaction_id }}</td>
                        <td class="px-6 py-4">{{ $payment->created_at->format('d M, Y - h:i A') }}</td>
                        <td class="px-6 py-4 text-right font-semibold text-green-600">₹{{ number_format($payment->amount) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12 border-2 border-dashed border-gold-100 rounded-xl">
            <p class="text-ink-900/50">No payments made yet.</p>
        </div>
        @endif

    </div>

@endsection