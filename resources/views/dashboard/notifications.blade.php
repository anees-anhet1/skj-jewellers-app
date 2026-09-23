@extends('layouts.dashboard')
@section('page-title','Notifications')
@section('content')
<div class="space-y-3">
    @foreach([
        ['Payment Successful','Your EMI of ₹2000 for Sri Akshayam Scheme was received.','2h ago'],
        ['Rate Alert','Gold rate (22K) is now ₹6,589.23/gm.','1d ago'],
        ['New Offer','Get up to 25% off on making charges.','3d ago'],
    ] as [$t,$d,$time])
    <div class="card p-5 flex gap-4">
        <div class="w-10 h-10 rounded-full bg-gold-50 flex items-center justify-center text-gold-500 shrink-0">🔔</div>
        <div class="flex-1">
            <div class="flex justify-between items-start">
                <p class="font-semibold text-sm">{{ $t }}</p>
                <span class="text-xs text-ink-900/40">{{ $time }}</span>
            </div>
            <p class="text-sm text-ink-900/60">{{ $d }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection
