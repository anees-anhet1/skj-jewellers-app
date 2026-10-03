@extends('layouts.dashboard')
@section('title', 'My Appointments - ' . config('brand.name'))

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-serif font-semibold text-ink-900 mb-2">My Appointments</h1>
    <p class="text-ink-900/60">View and manage your scheduled store visits.</p>
</div>

@if(session('success'))
    <div class="bg-emerald-50 text-emerald-700 px-4 py-3 rounded-xl mb-6 text-sm border border-emerald-200">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="bg-red-50 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm border border-red-200">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gold-100 overflow-hidden">
    @if($appointments->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gold-50/50 border-b border-gold-100">
                        <th class="p-4 font-semibold text-sm text-ink-900">Date</th>
                        <th class="p-4 font-semibold text-sm text-ink-900">Store</th>
                        <th class="p-4 font-semibold text-sm text-ink-900">Interested In</th>
                        <th class="p-4 font-semibold text-sm text-ink-900">Message</th>
                        <th class="p-4 font-semibold text-sm text-ink-900 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($appointments as $appointment)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-4">
                                <span class="font-medium text-ink-900">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</span>
                            </td>
                            <td class="p-4">
                                <span class="text-sm text-ink-900">{{ $appointment->store }}</span>
                            </td>
                            <td class="p-4">
                                @if($appointment->product)
                                    <a href="{{ url('/product/' . $appointment->product->id) }}" class="text-sm text-gold-600 hover:underline">
                                        {{ $appointment->product->name }}
                                    </a>
                                @else
                                    <span class="text-sm text-gray-500">General Visit</span>
                                @endif
                            </td>
                            <td class="p-4 text-sm text-gray-600 max-w-xs truncate" title="{{ $appointment->message }}">
                                {{ $appointment->message ?? '-' }}
                            </td>
                            <td class="p-4 text-right">
                                <form method="POST" action="{{ url('/dashboard/appointments/' . $appointment->id . '/cancel') }}" onsubmit="return confirm('Are you sure you want to cancel this appointment?');" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition">
                                        Cancel
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="p-12 text-center">
            <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-calendar-x text-2xl text-gray-400"></i>
            </div>
            <h3 class="font-serif font-semibold text-lg text-ink-900 mb-1">No Appointments Found</h3>
            <p class="text-gray-500 text-sm mb-6">You don't have any upcoming or past appointments.</p>
            <a href="{{ url('/book-appointment') }}" class="btn-gold !py-2 !px-6 text-sm">
                Book an Appointment
            </a>
        </div>
    @endif
</div>
@endsection
