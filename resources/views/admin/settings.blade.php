@extends('layouts.admin')
@section('page-title','Settings')
@section('content')
<div class="card p-8 max-w-lg space-y-4">
    <div><label class="text-xs text-ink-900/40">Store Name</label><input value="{{ config('brand.name') }}" class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100"></div>
    <div><label class="text-xs text-ink-900/40">Support Email</label><input value="{{ config('brand.email') }}" class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100"></div>
    <div><label class="text-xs text-ink-900/40">Support Phone</label><input value="+91 98765 43210" class="w-full mt-1 px-4 py-3 rounded-xl border border-gold-100"></div>
    <button class="btn-gold">Save Settings</button>
</div>
@endsection
