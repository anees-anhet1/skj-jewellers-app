@extends('layouts.admin')

@section('page-title', 'Edit Offer')

@section('content')

<div class="mb-6">
    <h2 class="font-serif font-semibold mb-4">Edit Offer</h2>

    <form method="POST" action="/admin/offers/{{ $offer->id }}" class="flex flex-wrap gap-3 items-center">
        @csrf
        @method('PUT')

        <input
            type="text"
            name="title"
            value="{{ $offer->title }}"
            placeholder="Offer title"
            required
            class="px-4 py-2 rounded-lg border border-gold-100"
        >

        <input
            type="number"
            name="discount"
            value="{{ $offer->discount }}"
            placeholder="Discount %"
            required
            min="0"
            max="100"
            step="1"
            oninput="this.value = Math.max(0, Math.min(100, this.value))"
            class="px-4 py-2 rounded-lg border border-gold-100 w-32"
        >

        <input
            type="date"
            name="valid_till"
            value="{{ $offer->valid_till->format('Y-m-d') }}"
            min="{{ date('Y-m-d') }}"
            required
            class="px-4 py-2 rounded-lg border border-gold-100"
        >

        <button type="submit" class="btn-gold !py-2 !px-5 text-sm">
            Update Offer
        </button>

        <a
            href="/admin/offers"
            class="btn-outline !py-2 text-sm"
        >
            Cancel
        </a>
    </form>

    @if ($errors->any())
        <div class="mt-4 text-red-600 text-sm">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</div>

@endsection