@extends('layouts.admin')
@section('page-title','Payments')
@section('content')
<div class="card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gold-50 text-ink-900/60">
            <tr><th class="text-left p-4">Trans ID</th><th class="text-left p-4">Customer</th><th class="text-left p-4">Plan</th><th class="text-left p-4">Amount</th><th class="text-left p-4">Date</th><th class="text-left p-4">Status</th></tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr class="border-t border-gold-50">
                <td class="p-4 font-mono text-xs">{{ $payment->transaction_id }}</td>
                <td class="p-4">{{ $payment->user->name ?? 'Deleted User' }}</td>
                <td class="p-4">{{ $payment->userPlan->plan->name ?? 'N/A' }}</td>
                <td class="p-4 font-medium">₹{{ number_format($payment->amount) }}</td>
                <td class="p-4">{{ $payment->created_at->format('d M Y, h:i A') }}</td>
                <td class="p-4">
                    @if($payment->status === 'success')
                        <span class="text-xs bg-green-50 text-green-600 px-3 py-1 rounded-full">Success</span>
                    @else
                        <span class="text-xs bg-red-50 text-red-600 px-3 py-1 rounded-full">{{ ucfirst($payment->status) }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="p-8 text-center text-ink-900/50">No payments recorded yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
