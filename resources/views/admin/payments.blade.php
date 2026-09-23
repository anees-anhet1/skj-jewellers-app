@extends('layouts.admin')
@section('page-title','Payments')
@section('content')
<div class="card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gold-50 text-ink-900/60">
            <tr><th class="text-left p-4">Trans ID</th><th class="text-left p-4">Customer</th><th class="text-left p-4">Amount</th><th class="text-left p-4">Date</th><th class="text-left p-4">Status</th></tr>
        </thead>
        <tbody>
            @for($i=0;$i<5;$i++)
            <tr class="border-t border-gold-50">
                <td class="p-4">258147369258{{147+$i}}</td><td class="p-4">Ravishankar D</td><td class="p-4">₹1,500</td><td class="p-4">19 Jun 2023</td>
                <td class="p-4"><span class="text-xs bg-green-50 text-green-600 px-3 py-1 rounded-full">Success</span></td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>
@endsection
