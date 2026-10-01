@extends('layouts.admin')
@section('page-title','Appointments')
@section('content')

@if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
        {{ session('success') }}
    </div>
@endif

<h2 class="font-serif font-semibold mb-4">Appointment Requests</h2>

<div class="space-y-4">
    @forelse($appointments as $appt)
    <div class="card p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="font-medium">{{ $appt->name }} — {{ $appt->phone }}</p>
                <p class="text-sm text-ink-900/60">{{ $appt->email }}</p>
                <p class="text-sm text-ink-900/60">{{ $appt->store }}</p>
                @if($appt->product)
                    <p class="text-sm mt-2">
                        <span class="bg-gold-100 text-gold-800 text-xs px-2 py-1 rounded-md font-semibold">Interested in: {{ $appt->product->name }}</span>
                    </p>
                @endif
                <p class="text-sm text-gold-600 font-medium mt-2">
                    Requested for {{ \Carbon\Carbon::parse($appt->appointment_date)->format('d M Y') }}
                </p>
                @if($appt->message)
                <p class="text-sm mt-2 text-ink-900/80">"{{ $appt->message }}"</p>
                @endif
            </div>
            <div class="flex flex-col items-end gap-2">
                <span class="text-xs text-ink-900/40">{{ $appt->created_at->diffForHumans() }}</span>
                <form method="POST" action="{{ url('/admin/appointments/' . $appt->id . '/delete') }}" onsubmit="return confirm('Delete this appointment request?')">
                    @csrf
                    <button type="submit" class="text-xs bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded-lg transition font-medium">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <p class="text-ink-900/50">No appointment requests yet.</p>
    @endforelse
</div>

@endsection