@extends('layouts.admin')
@section('page-title','Admin Overview')
@section('content')
<div class="grid md:grid-cols-4 gap-6 mb-8">
    <x-stat-card label="Total Customers" value="{{ $totalCustomers }}" sub="+{{ $newCustomersThisMonth }} this month" />
    <x-stat-card label="Active Plans" value="{{ $activePlans }}" />
    <x-stat-card label="Revenue (Total)" value="₹{{ number_format($totalRevenue) }}" />
    <x-stat-card label="Total Products" value="{{ $totalProducts }}" />
</div>
<div class="grid md:grid-cols-3 gap-6">
    <div class="card p-6 md:col-span-2">
        <h3 class="font-serif font-semibold mb-4">Recent Payments</h3>
        <table class="w-full text-sm">
            <thead class="text-ink-900/40 text-xs">
                <tr><th class="text-left py-2">Customer</th><th class="text-left py-2">Amount</th><th class="text-left py-2">Date</th><th class="text-left py-2">Status</th></tr>
            </thead>
            <tbody>
                @forelse($recentPayments as $payment)
                <tr class="border-t border-gold-50">
                    <td class="py-3">{{ $payment->user->name ?? 'Unknown' }}</td>
                    <td>₹{{ number_format($payment->amount) }}</td>
                    <td>{{ $payment->created_at->format('d M, h:i A') }}</td>
                    <td><span class="text-xs bg-green-50 text-green-600 px-3 py-1 rounded-full">{{ ucfirst($payment->status) }}</span></td>
                </tr>
                @empty
                <tr><td colspan="4" class="py-6 text-center text-ink-900/50">No payments recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card p-6">
        <h3 class="font-serif font-semibold mb-4">Today's Gold Rate</h3>
        @if($latestRate)
        <p class="text-3xl font-serif font-bold text-gold-500 mb-1">₹{{ number_format($latestRate->rate_22k, 2) }}</p>
        <p class="text-xs text-ink-900/40 mb-4">per gram (22K) · Updated {{ $latestRate->created_at->format('d M, h:i A') }}</p>
        @else
        <p class="text-ink-900/50 mb-4">No rate published yet.</p>
        @endif
        <a href="{{ url('/admin/gold-rate') }}" class="btn-outline w-full !py-2 text-sm text-center">Update Rate</a>
    </div>
</div>
@endsection
