@extends('layouts.dashboard')
@section('page-title','Profile')
@section('content')
<div class="card p-8 max-w-2xl">
    <div class="flex items-center gap-4 mb-8">
        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-gold-300 to-gold-500"></div>
        <div>
            <h3 class="font-serif text-xl font-semibold">Ravishankar D</h3>
            <p class="text-sm text-ink-900/50">Customer ID: AZ 0658</p>
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-5">
        <div><label class="text-xs text-ink-900/40">Full Name</label><input value="Ravishankar D" class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100"></div>
        <div><label class="text-xs text-ink-900/40">Phone</label><input value="+91 98765 43210" class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100"></div>
        <div><label class="text-xs text-ink-900/40">Email</label><input value="ravishankar@example.com" class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100"></div>
        <div><label class="text-xs text-ink-900/40">Address</label><input value="Chickpet, Bengaluru, Karnataka" class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100"></div>
    </div>
    <button class="btn-gold mt-6">Save Changes</button>
</div>
@endsection
