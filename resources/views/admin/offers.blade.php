@extends('layouts.admin')
@section('page-title','Offers')
@section('content')

<div class="mb-6">
    <h2 class="font-serif font-semibold mb-4">Add New Offer</h2>

    <form method="POST" action="/admin/offers" class="flex flex-wrap gap-3 items-center">
        @csrf

        <input
            type="text"
            name="title"
            placeholder="Offer title"
            required
            class="px-4 py-2 rounded-lg border border-gold-100"
        >

        <input
            type="number"
            name="discount"
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
            min="{{ date('Y-m-d') }}"
            required
            class="px-4 py-2 rounded-lg border border-gold-100"
        >

        <button type="submit" class="btn-gold !py-2 !px-5 text-sm">
            Save Offer
        </button>
    </form>

    @if ($errors->any())
        <div class="mt-4 text-red-600 text-sm">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</div>


<h2 class="font-serif font-semibold mb-4">All Offers</h2>

<div class="grid md:grid-cols-2 gap-6">

    @forelse($offers as $offer)

        <div class="card p-6 flex justify-between items-center">

            <div>
                <p class="font-medium">
                    {{ $offer->title }}
                </p>

                <p class="text-sm text-ink-900/50">
                    {{ $offer->discount }}% off,
                    till {{ $offer->valid_till->format('d M Y') }}
                </p>

                @if(\Carbon\Carbon::parse($offer->valid_till)->lt(\Carbon\Carbon::today()))
                    <p class="text-sm text-red-500 mt-1">
                        Expired
                    </p>
                @else
                    <p class="text-sm text-green-600 mt-1">
                        Active
                    </p>
                @endif
            </div>

            <div class="flex gap-2">

                <a
                    href="/admin/offers/{{ $offer->id }}/edit"
                    class="btn-gold !py-2 text-sm"
                >
                    Edit
                </a>

                <a
                    href="/admin/offers/{{ $offer->id }}/delete"
                    class="btn-outline !py-2 text-sm"
                >
                    Delete
                </a>

            </div>

        </div>

    @empty

        <p class="text-ink-900/50">
            No offers added yet.
        </p>

    @endforelse

</div>

@endsection