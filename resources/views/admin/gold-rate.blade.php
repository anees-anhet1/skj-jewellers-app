@extends('layouts.admin')
@section('page-title','Gold Rate')
@section('content')

@if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 max-w-lg">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 px-4 py-3 rounded-xl bg-red-50 text-red-700 border border-red-200 max-w-lg">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ url('/admin/gold-rate') }}" class="card p-8 max-w-lg"
      onsubmit="return confirm('Are you sure you want to publish this rate? It will be shown to all customers immediately.');">
    @csrf
    <h3 class="font-serif font-semibold mb-6">Update Today's Rate</h3>

    @if($rate && $previous)
        <div class="mb-6 text-sm space-y-1">
            <p>
                24K:
                @if($rate->rate_24k > $previous->rate_24k)
                    <span class="text-emerald-600 font-medium">▲ +₹{{ number_format($rate->rate_24k - $previous->rate_24k, 2) }} from last update</span>
                @elseif($rate->rate_24k < $previous->rate_24k)
                    <span class="text-red-600 font-medium">▼ -₹{{ number_format($previous->rate_24k - $rate->rate_24k, 2) }} from last update</span>
                @else
                    <span class="text-ink-900/50">No change from last update</span>
                @endif
            </p>
        </div>
    @endif

    <div class="space-y-4">
        <div>
            <label class="text-xs text-ink-900/40">24K Rate (per gram)</label>
            <input type="number" step="0.01" name="rate_24k" value="{{ $rate->rate_24k ?? '7180.00' }}" required class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100">
        </div>
        <div>
            <label class="text-xs text-ink-900/40">22K Rate (per gram)</label>
            <input type="number" step="0.01" name="rate_22k" value="{{ $rate->rate_22k ?? '6589.23' }}" required class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100">
        </div>
        <div>
            <label class="text-xs text-ink-900/40">Silver Rate (per gram)</label>
            <input type="number" step="0.01" name="rate_silver" value="{{ $rate->rate_silver ?? '86.50' }}" required class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100">
        </div>
    </div>
    <button type="submit" class="btn-gold mt-6">Publish Rate</button>
</form>

<div class="card p-8 max-w-lg mt-8">
    <h3 class="font-serif font-semibold mb-4">Recent Rate History</h3>
    <table class="w-full text-sm">
        <thead class="text-ink-900/50">
            <tr>
                <th class="text-left py-2">Date</th>
                <th class="text-left py-2">24K</th>
                <th class="text-left py-2">22K</th>
                <th class="text-left py-2">Silver</th>
            </tr>
        </thead>
        <tbody>
            @foreach($history as $h)
            <tr class="border-t border-gold-50">
                <td class="py-2">{{ $h->created_at->format('d M, h:i A') }}</td>
                <td class="py-2">₹{{ number_format($h->rate_24k, 2) }}</td>
                <td class="py-2">₹{{ number_format($h->rate_22k, 2) }}</td>
                <td class="py-2">₹{{ number_format($h->rate_silver, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection