@extends('layouts.app')
@section('title', 'Contact Us · '.config('brand.name'))
@section('content')
<div class="max-w-5xl mx-auto px-4 md:px-8 py-16 grid md:grid-cols-2 gap-12">
    <div>
        <x-section-heading eyebrow="Get in touch" title="Contact Us" />
        <p class="text-ink-900/60 mb-6">We'd love to hear from you. Reach out via phone, WhatsApp, mail, or visit our Chickpet, Bengaluru showroom.</p>
        <ul class="space-y-3 text-sm text-ink-900/70">
            <li>📞 {{ config('brand.phone') }}</li>
            <li>✉️ {{ config('brand.email') }}</li>
            <li>💬 WhatsApp: {{ config('brand.phone') }}</li>
            <li>📍 Chickpet, Bengaluru, Karnataka</li>
        </ul>
    </div>
    <div>
        @if(session('success'))
            <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 text-sm">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ url('/contact') }}" class="card p-8 space-y-4">
            @csrf
            <div>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:border-gold-400 focus:outline-none" required minlength="2" maxlength="100">
                @error('name') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:border-gold-400 focus:outline-none" required maxlength="150">
                @error('email') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Phone" class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:border-gold-400 focus:outline-none" required minlength="10" maxlength="10" pattern="^[0-9]{10}$" title="Please enter exactly 10 digits">
                @error('phone') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <textarea name="message" rows="5" placeholder="Message" class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:border-gold-400 focus:outline-none" required minlength="10" maxlength="2000">{{ old('message') }}</textarea>
                @error('message') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn-gold w-full">Send Message</button>
        </form>
    </div>
</div>
@endsection
