@extends('layouts.dashboard')
@section('page-title','Profile')
@section('content')
<div class="card p-8 max-w-2xl">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex items-center gap-4 mb-8">
        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-gold-300 to-gold-500 flex items-center justify-center text-white text-3xl font-serif">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
        <div>
            <h3 class="font-serif text-xl font-semibold">{{ auth()->user()->name }}</h3>
            <p class="text-sm text-ink-900/50">Customer ID: AZ {{ str_pad(auth()->id(), 4, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>
    <form action="/dashboard/profile" method="POST">
        @csrf
        <div class="grid md:grid-cols-2 gap-5">
            <div><label class="text-xs text-ink-900/40">Full Name</label><input type="text" name="name" value="{{ auth()->user()->name }}" class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100" required></div>
            <div><label class="text-xs text-ink-900/40">Phone</label><input type="tel" name="phone" pattern="[0-9]{10}" maxlength="10" title="Please enter a valid 10-digit phone number" value="{{ auth()->user()->phone ?? '' }}" class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100" placeholder="Enter your phone" required></div>
            <div><label class="text-xs text-ink-900/40">Email</label><input value="{{ auth()->user()->email }}" class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100" disabled></div>
            <div><label class="text-xs text-ink-900/40">Address</label><input type="text" name="address" value="{{ auth()->user()->address ?? '' }}" class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100" placeholder="Enter your address" required></div>
        </div>
        <button type="submit" class="btn-gold mt-6">Save Changes</button>
    </form>
</div>
@endsection
