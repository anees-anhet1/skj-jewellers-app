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

    <form method="POST" action="{{ url('/book-appointment') }}" class="bg-white rounded-3xl p-8 md:p-10 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-ink-900/5 space-y-6">
        @csrf
        
        <div class="border-b border-ink-900/5 pb-6 mb-6">
            <h3 class="font-serif text-2xl text-ink-900 mb-2">Personal Details</h3>
            <p class="text-sm text-ink-900/50">Let us know who we are expecting.</p>
        </div>

        @if(isset($product))
            <div class="bg-gradient-to-r from-gold-50/50 to-gold-50 p-5 rounded-2xl flex items-center gap-5 mb-6 border border-gold-200/50 shadow-sm">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded-xl shadow-sm border border-white">
                @else
                    <div class="w-20 h-20 bg-white rounded-xl flex items-center justify-center text-xs text-gold-600 shadow-sm">No Image</div>
                @endif
                <div>
                    <p class="text-[10px] text-gold-600 uppercase tracking-widest font-semibold mb-1">Inquiry For</p>
                    <p class="font-serif font-bold text-xl text-ink-900">{{ $product->name }}</p>
                    <p class="text-sm text-ink-900/60 mt-1">₹{{ number_format((float) $product->price) }}</p>
                </div>
            </div>
            <input type="hidden" name="product_id" value="{{ $product->id }}">
        @endif

        <div class="space-y-2">
            <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Full Name *</label>
            <input type="text" name="name" value="{{ auth()->check() ? auth()->user()->name : '' }}" {{ auth()->check() ? 'readonly' : '' }} placeholder="Enter your full name" required class="w-full px-4 py-3 rounded-xl border border-ink-900/10 focus:outline-none focus:ring-2 focus:ring-gold-300 focus:border-transparent transition-all duration-300 {{ auth()->check() ? 'bg-ink-900/10 text-ink-900/60 cursor-not-allowed font-medium' : 'bg-ink-900/5 focus:bg-white' }}">
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Email Address *</label>
                <input type="email" name="email" value="{{ auth()->check() ? auth()->user()->email : '' }}" {{ auth()->check() ? 'readonly' : '' }} placeholder="Enter your email address" required class="w-full px-4 py-3 rounded-xl border border-ink-900/10 focus:outline-none focus:ring-2 focus:ring-gold-300 focus:border-transparent transition-all duration-300 {{ auth()->check() ? 'bg-ink-900/10 text-ink-900/60 cursor-not-allowed font-medium' : 'bg-ink-900/5 focus:bg-white' }}">
            </div>
            
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Phone Number *</label>
                <input type="tel" name="phone" value="{{ auth()->check() ? auth()->user()->phone : '' }}" {{ auth()->check() && auth()->user()->phone ? 'readonly' : '' }} placeholder="Enter your phone number" required class="w-full px-4 py-3 rounded-xl border border-ink-900/10 focus:outline-none focus:ring-2 focus:ring-gold-300 focus:border-transparent transition-all duration-300 {{ auth()->check() && auth()->user()->phone ? 'bg-ink-900/10 text-ink-900/60 cursor-not-allowed font-medium' : 'bg-ink-900/5 focus:bg-white' }}">
                @if(auth()->check() && !auth()->user()->phone)
                    <p class="text-[10px] text-gold-600 mt-1 text-left">Please provide a phone number so we can contact you.</p>
                @endif
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Preferred Store *</label>
                <select name="store" class="w-full px-4 py-3 rounded-xl border border-ink-900/10 bg-ink-900/5 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gold-300 focus:border-transparent transition-all duration-300 appearance-none">
                    @foreach(config('brand.stores') as $store)
                        <option value="{{ config('brand.name') }} – {{ $store['area'] }}, {{ $store['city'] }}">
                            {{ config('brand.name') }} – {{ $store['area'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Preferred Date *</label>
                <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" required class="w-full px-4 py-3 rounded-xl border border-ink-900/10 bg-ink-900/5 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gold-300 focus:border-transparent transition-all duration-300 text-ink-900/70">
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Additional Notes (Optional)</label>
            <textarea name="message" placeholder="Are you looking for something specific?" rows="4" class="w-full px-4 py-3 rounded-xl border border-ink-900/10 bg-ink-900/5 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gold-300 focus:border-transparent transition-all duration-300"></textarea>
        </div>
        
        <div class="pt-4">
            <button type="submit" class="w-full bg-ink-900 hover:bg-ink-800 text-white font-medium tracking-wide py-4 rounded-xl transition duration-300 shadow-lg shadow-ink-900/20 hover:shadow-xl hover:shadow-ink-900/30 hover:-translate-y-0.5">
                Confirm Appointment
            </button>
        </div>
    </form>
</div>
@endsection