@extends('layouts.admin')
@section('page-title','Customers')
@section('content')
<div class="card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gold-50 text-ink-900/60">
            <tr><th class="text-left p-4">ID</th><th class="text-left p-4">Name</th><th class="text-left p-4">Phone</th><th class="text-left p-4">Active Plans</th><th class="text-left p-4">Status</th></tr>
        </thead>
        <tbody>
            @foreach(['AZ 0658'=>'Ravishankar D','AZ 0659'=>'Sasikumar','AZ 0660'=>'Priya M'] as $id => $name)
            <tr class="border-t border-gold-50">
                <td class="p-4">{{ $id }}</td><td class="p-4">{{ $name }}</td><td class="p-4">+91 98765 43210</td><td class="p-4">2</td>
                <td class="p-4"><span class="text-xs bg-green-50 text-green-600 px-3 py-1 rounded-full">Active</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
