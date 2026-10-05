@extends('layouts.admin')
@section('page-title','Contact Messages')
@section('content')

@if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
        {{ session('success') }}
    </div>
@endif

{{-- Stats Cards --}}
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
    <div class="card p-4 text-center {{ request('status', 'all') == 'all' ? 'ring-2 ring-gold-400' : '' }}">
        <a href="{{ url('/admin/contact-messages') }}" class="block">
            <p class="text-2xl font-serif font-bold text-ink-900">{{ $stats['total'] }}</p>
            <p class="text-xs text-ink-900/50 mt-1">Total</p>
        </a>
    </div>
    <div class="card p-4 text-center {{ request('status') == 'new' ? 'ring-2 ring-gold-400' : '' }}">
        <a href="{{ url('/admin/contact-messages?status=new') }}" class="block">
            <p class="text-2xl font-serif font-bold text-blue-600">{{ $stats['new'] }}</p>
            <p class="text-xs text-ink-900/50 mt-1">New</p>
        </a>
    </div>
    <div class="card p-4 text-center {{ request('status') == 'read' ? 'ring-2 ring-gold-400' : '' }}">
        <a href="{{ url('/admin/contact-messages?status=read') }}" class="block">
            <p class="text-2xl font-serif font-bold text-gold-500">{{ $stats['read'] }}</p>
            <p class="text-xs text-ink-900/50 mt-1">Read</p>
        </a>
    </div>
    <div class="card p-4 text-center {{ request('status') == 'replied' ? 'ring-2 ring-gold-400' : '' }}">
        <a href="{{ url('/admin/contact-messages?status=replied') }}" class="block">
            <p class="text-2xl font-serif font-bold text-emerald-600">{{ $stats['replied'] }}</p>
            <p class="text-xs text-ink-900/50 mt-1">Replied</p>
        </a>
    </div>
    <div class="card p-4 text-center {{ request('status') == 'archived' ? 'ring-2 ring-gold-400' : '' }}">
        <a href="{{ url('/admin/contact-messages?status=archived') }}" class="block">
            <p class="text-2xl font-serif font-bold text-ink-900/40">{{ $stats['archived'] }}</p>
            <p class="text-xs text-ink-900/50 mt-1">Archived</p>
        </a>
    </div>
</div>

{{-- Search Bar --}}
<form method="GET" action="{{ url('/admin/contact-messages') }}" class="mb-6 flex gap-3">
    <input type="hidden" name="status" value="{{ request('status', 'all') }}">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or subject..."
        class="flex-1 px-4 py-3 rounded-xl border border-gold-100 focus:border-gold-400 focus:ring-2 focus:ring-gold-400/20 outline-none transition text-sm">
    <button type="submit" class="btn-gold !px-6 !py-3 text-sm">
        <i class="bi bi-search mr-1"></i> Search
    </button>
    @if(request('search'))
        <a href="{{ url('/admin/contact-messages') }}?status={{ request('status', 'all') }}" class="btn-outline !px-4 !py-3 text-sm">Clear</a>
    @endif
</form>

{{-- Messages List --}}
<div class="space-y-4">
    @forelse($messages as $msg)
    <a href="{{ url('/admin/contact-messages/' . $msg->id) }}" class="block">
        <div class="card p-6 hover:shadow-lg transition {{ $msg->status === 'new' ? 'border-l-4 border-l-blue-500' : '' }}">
            <div class="flex justify-between items-start gap-4">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-1">
                        <h3 class="font-medium text-ink-900 truncate">{{ $msg->name }}</h3>
                        @if($msg->status === 'new')
                            <span class="text-[10px] bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-semibold uppercase tracking-wide flex-shrink-0">New</span>
                        @elseif($msg->status === 'read')
                            <span class="text-[10px] bg-gold-100 text-gold-700 px-2 py-0.5 rounded-full font-semibold uppercase tracking-wide flex-shrink-0">Read</span>
                        @elseif($msg->status === 'replied')
                            <span class="text-[10px] bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full font-semibold uppercase tracking-wide flex-shrink-0">Replied</span>
                        @elseif($msg->status === 'archived')
                            <span class="text-[10px] bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full font-semibold uppercase tracking-wide flex-shrink-0">Archived</span>
                        @endif
                    </div>
                    <p class="text-sm text-ink-900/60 truncate">{{ $msg->email }} @if($msg->phone) · {{ $msg->phone }} @endif</p>
                    <p class="text-sm font-medium text-gold-600 mt-1">{{ $msg->subject }}</p>
                    <p class="text-sm text-ink-900/50 mt-1 line-clamp-2">{{ Str::limit($msg->message, 120) }}</p>
                </div>
                <div class="flex flex-col items-end gap-2 flex-shrink-0">
                    <span class="text-xs text-ink-900/40">{{ $msg->created_at->diffForHumans() }}</span>
                    <i class="bi bi-chevron-right text-ink-900/30"></i>
                </div>
            </div>
        </div>
    </a>
    @empty
    <div class="card p-12 text-center">
        <i class="bi bi-envelope text-4xl text-ink-900/20 mb-3 block"></i>
        <p class="text-ink-900/50">No messages found.</p>
    </div>
    @endforelse
</div>

@endsection
