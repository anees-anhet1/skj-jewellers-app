@extends('layouts.admin')
@section('page-title','Customers')
@section('content')

@if(session('success'))
    <div class="mb-6 px-4 py-3 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
        {{ session('success') }}
    </div>
@endif

<div class="card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gold-50 text-ink-900/60">
            <tr><th class="text-left p-4">ID</th><th class="text-left p-4">Name</th><th class="text-left p-4">Phone</th><th class="text-left p-4">Active Plans</th><th class="text-left p-4">Status</th><th class="text-left p-4">Actions</th></tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr class="border-t border-gold-50">
                <td class="p-4">AZ {{ str_pad($customer->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td class="p-4">{{ $customer->name }}</td>
                <td class="p-4">{{ $customer->phone ?? 'N/A' }}</td>
                <td class="p-4">{{ $customer->plans_count }}</td>
                <td class="p-4"><span class="text-xs bg-green-50 text-green-600 px-3 py-1 rounded-full">Active</span></td>
                <td class="p-4">
                    <form method="POST" action="{{ url('/admin/customers/' . $customer->id . '/delete') }}" onsubmit="return confirm('Are you sure you want to delete customer {{ $customer->name }}? This will also delete their plans, payments, and wishlist data. This action cannot be undone.')">
                        @csrf
                        <button type="submit" class="text-xs bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded-lg transition font-medium">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
