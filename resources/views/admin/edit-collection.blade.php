@extends('layouts.admin')
@section('page-title', 'Edit Collection')
@section('content')

<div class="max-w-2xl">
    <div class="card p-8">
        <h3 class="font-serif font-semibold text-xl mb-6">Edit Collection</h3>
        <form action="{{ url('/admin/collections/' . $collection->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Collection Name</label>
                <input type="text" name="name" value="{{ $collection->name }}" required class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:outline-none focus:ring-2 focus:ring-gold-300">
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:outline-none focus:ring-2 focus:ring-gold-300">{{ $collection->description }}</textarea>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wider text-ink-900/70">Cover Image</label>
                @if($collection->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $collection->image) }}" class="w-24 h-24 rounded-xl object-cover border border-gold-100">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" class="w-full text-sm text-ink-900/60 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gold-50 file:text-gold-700 hover:file:bg-gold-100">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-gold !py-2.5 !px-8 text-sm">Update Collection</button>
                <a href="{{ url('/admin/collections') }}" class="px-6 py-2.5 rounded-full border border-ink-900/10 text-sm hover:bg-ink-900/5 transition">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
