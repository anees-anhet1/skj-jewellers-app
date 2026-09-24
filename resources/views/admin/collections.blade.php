@extends('layouts.admin')
@section('page-title', 'Manage Collections')
@section('content')

@if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 px-4 py-3 rounded-xl bg-red-50 text-red-700 border border-red-200">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="grid lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1">
        <form method="POST" action="{{ url('/admin/collections') }}" enctype="multipart/form-data" class="card p-6">
            @csrf
            <h3 class="font-serif font-semibold text-lg mb-6">Add New Collection</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="text-xs text-ink-900/40">Collection Name</label>
                    <input type="text" name="name" required class="w-full mt-1 px-4 py-2.5 rounded-xl border border-gold-100 focus:outline-none focus:border-gold-300">
                </div>
                <div>
                    <label class="text-xs text-ink-900/40">Description</label>
                    <textarea name="description" rows="3" class="w-full mt-1 px-4 py-2.5 rounded-xl border border-gold-100 focus:outline-none focus:border-gold-300"></textarea>
                </div>
                <div>
                    <label class="text-xs text-ink-900/40">Cover Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full mt-1 text-sm text-ink-900/60 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gold-50 file:text-gold-700 hover:file:bg-gold-100">
                </div>
            </div>
            
            <button type="submit" class="btn-gold w-full mt-6">Create Collection</button>
        </form>
    </div>

    <div class="lg:col-span-2">
        <div class="card p-6">
            <h3 class="font-serif font-semibold text-lg mb-6">Existing Collections</h3>
            
            @if($collections->count() > 0)
                <div class="grid sm:grid-cols-2 gap-4">
                    @foreach($collections as $collection)
                    <div class="border border-gold-100 rounded-2xl p-4 flex gap-4 items-center group">
                        <div class="w-20 h-20 rounded-xl bg-gold-50 overflow-hidden shrink-0">
                            @if($collection->image)
                                <img src="{{ asset('storage/' . $collection->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gold-300"><i class="bi bi-image"></i></div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-ink-900 truncate">{{ $collection->name }}</h4>
                            <p class="text-xs text-ink-900/50 mt-1 mb-2">{{ $collection->products->count() }} Products</p>
                            <a href="{{ url('/admin/collections/'.$collection->id.'/delete') }}" onclick="return confirm('Delete this collection?')" class="text-xs text-red-500 hover:text-red-700 font-medium">Delete</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-ink-900/50 text-center py-8">No collections created yet.</p>
            @endif
        </div>
    </div>
</div>

@endsection
