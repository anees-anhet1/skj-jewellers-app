@extends('layouts.admin')
@section('page-title','Settings')
@section('content')

<div class="max-w-4xl mx-auto space-y-8 mt-4">
    <div class="card overflow-hidden border-0 shadow-sm bg-white">
        <div class="border-b border-gray-100 bg-gray-50/50 px-8 py-6">
            <h3 class="font-serif text-xl font-semibold text-ink-900">Store Identity</h3>
            <p class="text-sm text-gray-500 mt-1">Manage your store's branding and public contact information.</p>
        </div>
        
        <div class="p-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-ink-900 mb-1">Store Name</label>
                    <p class="text-xs text-gray-500 leading-relaxed">This will be displayed publicly across your storefront and customer emails.</p>
                </div>
                <div class="md:col-span-2">
                    <input type="text" value="{{ config('brand.name', 'V Anand Jewellery') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-gold-400 focus:ring-2 focus:ring-gold-100 outline-none transition-all text-ink-900 bg-gray-50 focus:bg-white" placeholder="e.g. V Anand Jewellery">
                </div>
            </div>
            
            <hr class="border-gray-100 border-dashed">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-ink-900 mb-1">Support Email</label>
                    <p class="text-xs text-gray-500 leading-relaxed">The primary email address where customers will send support inquiries.</p>
                </div>
                <div class="md:col-span-2">
                    <input type="email" value="{{ config('brand.email', 'care@vanandjewellery.com') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-gold-400 focus:ring-2 focus:ring-gold-100 outline-none transition-all text-ink-900 bg-gray-50 focus:bg-white" placeholder="care@example.com">
                </div>
            </div>
            
            <hr class="border-gray-100 border-dashed">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-ink-900 mb-1">Support Phone</label>
                    <p class="text-xs text-gray-500 leading-relaxed">Toll-free or regular phone number for direct customer phone support.</p>
                </div>
                <div class="md:col-span-2">
                    <input type="text" value="+91 98765 43210" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-gold-400 focus:ring-2 focus:ring-gold-100 outline-none transition-all text-ink-900 bg-gray-50 focus:bg-white" placeholder="+91 00000 00000">
                </div>
            </div>
        </div>
        
        <div class="bg-gray-50/80 px-8 py-5 border-t border-gray-100 flex items-center justify-end">
            <button class="btn-gold flex items-center gap-2 px-8 shadow-md">
                <i class="bi bi-check2-circle text-lg"></i>
                Save Preferences
            </button>
        </div>
    </div>
</div>
@endsection
