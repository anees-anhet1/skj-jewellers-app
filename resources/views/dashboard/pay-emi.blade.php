@extends('layouts.dashboard')
@section('page-title','Pay EMI')
@section('content')
<div x-data="{selected:1}" class="space-y-4 pb-24">
    @foreach(['Sri Akshayam Scheme','Swarna Dharaa','Swarna Dharaa'] as $i => $plan)
    <label class="card p-5 flex items-center justify-between cursor-pointer" :class="selected==={{ $i }} ? 'ring-2 ring-gold-400' : ''">
        <div>
            <p class="text-xs text-ink-900/40">Ravishankar D</p>
            <p class="font-serif font-semibold mb-2">{{ $plan }}</p>
            <div class="grid grid-cols-3 gap-4 text-xs">
                <div><p class="text-ink-900/40">Your ID</p><p class="font-medium">AZ 0658</p></div>
                <div><p class="text-ink-900/40">Pay Amount</p><p class="font-medium">₹2000</p></div>
                <div><p class="text-ink-900/40">Total Dues</p><p class="font-medium">03/12</p></div>
            </div>
        </div>
        <input type="radio" name="plan" @click="selected={{ $i }}" class="accent-gold-400 w-5 h-5">
    </label>
    @endforeach

    <div class="fixed bottom-0 left-0 lg:left-72 right-0 bg-ink-900 text-white p-4 flex items-center justify-between px-8">
        <span class="text-sm">1 Selected | ₹2000</span>
        <button class="bg-white text-ink-900 px-8 py-2 rounded-full font-semibold text-sm">Pay via Razorpay</button>
    </div>
</div>
@endsection
