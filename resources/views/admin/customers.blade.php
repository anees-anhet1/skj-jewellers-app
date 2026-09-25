@extends('layouts.admin')
@section('page-title','Customers')
@section('content')
<div class="card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gold-50 text-ink-900/60">
            <tr><th class="text-left p-4">ID</th><th class="text-left p-4">Name</th><th class="text-left p-4">Phone</th><th class="text-left p-4">Active Plans</th><th class="text-left p-4">Status</th></tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr class="border-t border-gold-50">
                <td class="p-4">AZ {{ str_pad($customer->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td class="p-4">{{ $customer->name }}</td>
                <td class="p-4">{{ $customer->phone ?? 'N/A' }}</td>
                <td class="p-4">{{ $customer->plans_count }}</td>
                <td class="p-4"><span class="text-xs bg-green-50 text-green-600 px-3 py-1 rounded-full">Active</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
