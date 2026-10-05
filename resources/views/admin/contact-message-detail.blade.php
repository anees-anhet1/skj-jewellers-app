@extends('layouts.admin')
@section('page-title', 'Message from ' . $contactMessage->name)
@section('content')

@if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
        {{ session('success') }}
    </div>
@endif

<div class="mb-6">
    <a href="{{ url('/admin/contact-messages') }}" class="text-sm text-gold-500 hover:text-gold-600 transition flex items-center gap-1">
        <i class="bi bi-arrow-left"></i> Back to all messages
    </a>
</div>

<div class="grid lg:grid-cols-3 gap-6">

    {{-- Main Message Card --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="card p-8">
            {{-- Header --}}
            <div class="flex items-start justify-between mb-6 pb-6 border-b border-gold-50">
                <div>
                    <h2 class="font-serif text-xl font-semibold text-ink-900">{{ $contactMessage->subject }}</h2>
                    <p class="text-sm text-ink-900/50 mt-1">Received {{ $contactMessage->created_at->format('d M Y, h:i A') }} · {{ $contactMessage->created_at->diffForHumans() }}</p>
                </div>
                @if($contactMessage->status === 'new')
                    <span class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-semibold uppercase tracking-wide">New</span>
                @elseif($contactMessage->status === 'read')
                    <span class="text-xs bg-gold-100 text-gold-700 px-3 py-1 rounded-full font-semibold uppercase tracking-wide">Read</span>
                @elseif($contactMessage->status === 'replied')
                    <span class="text-xs bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full font-semibold uppercase tracking-wide">Replied</span>
                @elseif($contactMessage->status === 'archived')
                    <span class="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-full font-semibold uppercase tracking-wide">Archived</span>
                @endif
            </div>

            {{-- Message Body --}}
            <div class="prose prose-sm max-w-none text-ink-900/80 leading-relaxed whitespace-pre-wrap">{{ $contactMessage->message }}</div>
        </div>

        {{-- Admin Notes --}}
        <div class="card p-8">
            <h3 class="font-serif font-semibold mb-4 flex items-center gap-2">
                <i class="bi bi-journal-text text-gold-500"></i> Internal Notes
            </h3>
            <form method="POST" action="{{ url('/admin/contact-messages/' . $contactMessage->id . '/notes') }}">
                @csrf
                <textarea name="admin_notes" rows="4" placeholder="Add internal notes about this message (only visible to admins)..."
                    class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:border-gold-400 focus:ring-2 focus:ring-gold-400/20 outline-none transition resize-none text-sm">{{ old('admin_notes', $contactMessage->admin_notes) }}</textarea>
                @error('admin_notes')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn-outline !py-2 !px-5 text-sm mt-3">
                    <i class="bi bi-check2 mr-1"></i> Save Notes
                </button>
            </form>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-6">

        {{-- Sender Info --}}
        <div class="card p-6">
            <h3 class="font-serif font-semibold mb-4">Sender Details</h3>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center text-white font-serif font-bold text-lg shadow-md">
                        {{ strtoupper(substr($contactMessage->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-medium text-ink-900">{{ $contactMessage->name }}</p>
                        @if($contactMessage->user)
                            <p class="text-xs text-gold-500 font-medium">Registered Customer</p>
                        @else
                            <p class="text-xs text-ink-900/40">Guest</p>
                        @endif
                    </div>
                </div>
                <div class="space-y-3 pt-2">
                    <a href="mailto:{{ $contactMessage->email }}" class="flex items-center gap-3 text-sm text-ink-900/70 hover:text-gold-500 transition">
                        <i class="bi bi-envelope text-gold-400"></i>
                        {{ $contactMessage->email }}
                    </a>
                    @if($contactMessage->phone)
                    <a href="tel:{{ $contactMessage->phone }}" class="flex items-center gap-3 text-sm text-ink-900/70 hover:text-gold-500 transition">
                        <i class="bi bi-telephone text-gold-400"></i>
                        {{ $contactMessage->phone }}
                    </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="card p-6">
            <h3 class="font-serif font-semibold mb-4">Actions</h3>
            <div class="space-y-3">
                {{-- Reply via Email --}}
                <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ urlencode($contactMessage->subject) }}" 
                   class="flex items-center gap-3 w-full px-4 py-3 rounded-xl bg-gold-50 text-gold-700 hover:bg-gold-100 transition text-sm font-medium">
                    <i class="bi bi-reply-fill"></i> Reply via Email
                </a>

                @if($contactMessage->phone)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactMessage->phone) }}" target="_blank"
                   class="flex items-center gap-3 w-full px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition text-sm font-medium">
                    <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
                @endif

                {{-- Status Update --}}
                <form method="POST" action="{{ url('/admin/contact-messages/' . $contactMessage->id . '/status') }}">
                    @csrf
                    <select name="status" onchange="this.form.submit()"
                        class="w-full px-4 py-3 rounded-xl border border-gold-100 focus:border-gold-400 outline-none text-sm bg-white">
                        <option value="new" {{ $contactMessage->status === 'new' ? 'selected' : '' }}>📩 Mark as New</option>
                        <option value="read" {{ $contactMessage->status === 'read' ? 'selected' : '' }}>👁️ Mark as Read</option>
                        <option value="replied" {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>✅ Mark as Replied</option>
                        <option value="archived" {{ $contactMessage->status === 'archived' ? 'selected' : '' }}>📦 Archive</option>
                    </select>
                </form>

                {{-- Delete --}}
                <form method="POST" action="{{ url('/admin/contact-messages/' . $contactMessage->id . '/delete') }}" onsubmit="return confirm('Are you sure you want to permanently delete this message?')">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl bg-red-50 text-red-600 hover:bg-red-100 transition text-sm font-medium">
                        <i class="bi bi-trash3"></i> Delete Message
                    </button>
                </form>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="card p-6">
            <h3 class="font-serif font-semibold mb-4">Timeline</h3>
            <div class="space-y-4 text-sm">
                <div class="flex items-start gap-3">
                    <div class="w-2 h-2 mt-1.5 rounded-full bg-blue-500 flex-shrink-0"></div>
                    <div>
                        <p class="text-ink-900/70">Message received</p>
                        <p class="text-xs text-ink-900/40">{{ $contactMessage->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>
                @if($contactMessage->read_at)
                <div class="flex items-start gap-3">
                    <div class="w-2 h-2 mt-1.5 rounded-full bg-gold-500 flex-shrink-0"></div>
                    <div>
                        <p class="text-ink-900/70">Opened by admin</p>
                        <p class="text-xs text-ink-900/40">{{ $contactMessage->read_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>
                @endif
                @if($contactMessage->replied_at)
                <div class="flex items-start gap-3">
                    <div class="w-2 h-2 mt-1.5 rounded-full bg-emerald-500 flex-shrink-0"></div>
                    <div>
                        <p class="text-ink-900/70">Marked as replied</p>
                        <p class="text-xs text-ink-900/40">{{ $contactMessage->replied_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection
