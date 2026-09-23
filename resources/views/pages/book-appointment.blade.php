@extends('layouts.app')
@section('title', 'Book Appointment · '.config('brand.name'))
@section('content')
<div class="max-w-3xl mx-auto px-4 md:px-8 py-16">
    <x-section-heading eyebrow="Visit Us" title="Book an Appointment" center />

    @if(session('success'))
        <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/book-appointment') }}" class="card p-8 space-y-5">
        @csrf
        <div class="grid md:grid-cols-2 gap-5">
            <input type="text" name="name" placeholder="Full Name" required class="px-4 py-3 rounded-xl border border-gold-100 focus:outline-none focus:ring-2 focus:ring-gold-300">
            <input type="tel" name="phone" placeholder="Phone Number" required class="px-4 py-3 rounded-xl border border-gold-100 focus:outline-none focus:ring-2 focus:ring-gold-300">
        </div>
        <input type="email" name="email" placeholder="Email Address" required class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:outline-none focus:ring-2 focus:ring-gold-300">
        <div class="grid md:grid-cols-2 gap-5">
            <select name="store" class="px-4 py-3 rounded-xl border border-gold-100">
                @foreach(config('brand.stores') as $store)
                    <option value="{{ config('brand.name') }} – {{ $store['area'] }}, {{ $store['city'] }}">
                        {{ config('brand.name') }} – {{ $store['area'] }}, {{ $store['city'] }}
                    </option>
                @endforeach
            </select>
            <input type="date" name="appointment_date" required class="px-4 py-3 rounded-xl border border-gold-100">
        </div>
        <textarea name="message" placeholder="What are you looking for?" rows="4" class="w-full px-4 py-3 rounded-xl border border-gold-100"></textarea>
        <button type="submit" class="btn-gold w-full">Confirm Appointment</button>
    </form>
</div>
@endsection