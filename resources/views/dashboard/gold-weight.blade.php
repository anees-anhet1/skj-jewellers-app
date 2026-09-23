@extends('layouts.dashboard')
@section('page-title','Gold Weight')
@section('content')
<div class="grid md:grid-cols-2 gap-6 mb-8">
    <x-stat-card label="Total Weight" value="2.05 grm" />
    <x-stat-card label="Paid Dues" value="12" />
</div>
<div class="space-y-4">
    @foreach([1,2] as $i)
    <div class="card p-5">
        <div class="flex justify-between items-start mb-3">
            <div>
                <p class="text-xs text-ink-900/40">Ravishankar D</p>
                <p class="font-serif font-semibold">Sri Akshayam Scheme</p>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-3 text-xs">
            <div><p class="text-ink-900/40">Your ID</p><p class="font-medium">AZ 0658</p></div>
            <div><p class="text-ink-900/40">Paid Amount</p><p class="font-medium">₹2000</p></div>
            <div><p class="text-ink-900/40">Weight</p><p class="font-medium">0.8g</p></div>
            <div><p class="text-ink-900/40">Total Dues</p><p class="font-medium">03/12</p></div>
        </div>
    </div>
    @endforeach
</div>
@endsection
