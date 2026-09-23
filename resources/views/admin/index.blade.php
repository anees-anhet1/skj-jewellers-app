@extends('layouts.admin')
@section('page-title','Admin Overview')
@section('content')
<div class="grid md:grid-cols-4 gap-6 mb-8">
    <x-stat-card label="Total Customers" value="4,812" sub="+120 this month" />
    <x-stat-card label="Active Plans" value="1,204" />
    <x-stat-card label="Revenue (MTD)" value="₹42.6L" />
    <x-stat-card label="Gold Disbursed" value="18.4 kg" />
</div>
<div class="grid md:grid-cols-3 gap-6">
    <div class="card p-6 md:col-span-2">
        <h3 class="font-serif font-semibold mb-4">Recent Payments</h3>
        <table class="w-full text-sm">
            <thead class="text-ink-900/40 text-xs">
                <tr><th class="text-left py-2">Customer</th><th class="text-left py-2">Plan</th><th class="text-left py-2">Amount</th><th class="text-left py-2">Status</th></tr>
            </thead>
            <tbody>
                @foreach(['Ravishankar D','Sasikumar','Priya M','Arjun K'] as $c)
                <tr class="border-t border-gold-50">
                    <td class="py-3">{{ $c }}</td><td>Sri Akshayam</td><td>₹2,000</td>
                    <td><span class="text-xs bg-green-50 text-green-600 px-3 py-1 rounded-full">Paid</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card p-6">
        <h3 class="font-serif font-semibold mb-4">Today's Gold Rate</h3>
        <p class="text-3xl font-serif font-bold text-gold-500 mb-1">₹6,589.23</p>
        <p class="text-xs text-ink-900/40 mb-4">per gram (22K)</p>
        <button class="btn-outline w-full !py-2 text-sm">Update Rate</button>
    </div>
</div>
@endsection
