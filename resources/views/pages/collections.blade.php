@extends('layouts.app')
@section('title', 'Collections · '.config('brand.name'))
@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-8 py-12">
    <x-section-heading eyebrow="Curated" title="Our Collections" />
    <div class="grid md:grid-cols-3 gap-8">
        @forelse($collections as $collection)
        <div class="card overflow-hidden group">
            <div class="aspect-[4/3] bg-gradient-to-br from-gold-50 to-gold-100 relative overflow-hidden">
                @if($collection->image)
                    <img src="{{ asset('storage/' . $collection->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gold-300"><i class="bi bi-images text-4xl"></i></div>
                @endif
            </div>
            <div class="p-6">
                <h3 class="font-serif font-semibold text-lg mb-1">{{ $collection->name }}</h3>
                <p class="text-sm text-ink-900/60 mb-4 line-clamp-2">{{ $collection->description ?? 'Discover our beautiful ' . $collection->name . ' collection.' }}</p>
                <a href="{{ url('/shop?collection_id=' . $collection->id) }}" class="text-gold-500 text-sm font-semibold hover:text-gold-600">View Collection →</a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-16 bg-gold-50/30 rounded-3xl border border-gold-100">
            <h3 class="font-serif text-xl font-semibold mb-2">Coming Soon</h3>
            <p class="text-ink-900/50">We are curating our new collections. Check back shortly!</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
