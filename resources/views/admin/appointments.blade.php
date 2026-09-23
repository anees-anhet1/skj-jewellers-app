@extends('layouts.admin')
@section('page-title','Appointments')
@section('content')

<h2 class="font-serif font-semibold mb-4">Appointment Requests</h2>

<div class="space-y-4">
    @forelse($appointments as $appt)
    <div class="card p-6">
        <div class="flex justify-between items-start">
            <div>
                <p class="font-medium">{{ $appt->name }} — {{ $appt->phone }}</p>
                <p class="text-sm text-ink-900/60">{{ $appt->email }}</p>
                <p class="text-sm text-ink-900/60">{{ $appt->store }}</p>
                <p class="text-sm text-gold-600 font-medium mt-1">
                    Requested for {{ \Carbon\Carbon::parse($appt->appointment_date)->format('d M Y') }}
                </p>
                @if($appt->message)
                <p class="text-sm mt-2 text-ink-900/80">"{{ $appt->message }}"</p>
                @endif
            </div>
            <span class="text-xs text-ink-900/40">{{ $appt->created_at->diffForHumans() }}</span>
        </div>
    </div>
    @empty
    <p class="text-ink-900/50">No appointment requests yet.</p>
    @endforelse
</div>

@endsection