@extends('layouts.dashboard')
@section('page-title', 'Payment History')
@section('content')

    <div class="card overflow-hidden">
        @if($payments->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-gold-50/50 text-ink-900/60 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="px-6 py-4 font-medium">Date</th>
                            <th class="px-6 py-4 font-medium">Transaction ID</th>
                            <th class="px-6 py-4 font-medium">Plan Name</th>
                            <th class="px-6 py-4 font-medium text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gold-100">
                        @foreach($payments as $payment)
                            <tr class="hover:bg-gold-50/30 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $payment->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 font-mono text-xs">{{ $payment->transaction_id }}</td>
                                <td class="px-6 py-4 font-serif font-medium">{{ $payment->userPlan->plan->name }}</td>
                                <td class="px-6 py-4 text-right font-semibold text-green-600">₹{{ number_format($payment->amount) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16">
                <div
                    class="w-16 h-16 bg-gold-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gold-400 text-2xl">
                    🧾</div>
                <h3 class="font-serif text-xl font-semibold mb-2">No Transactions Yet</h3>
                <p class="text-ink-900/60">Your payment receipts will appear here.</p>
            </div>
        @endif
    </div>

@endsection