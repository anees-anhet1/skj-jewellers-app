@extends('layouts.admin')
@section('page-title','Reports')
@section('content')
<div class="grid md:grid-cols-3 gap-6 mb-8">
    <x-stat-card label="This Month Revenue" value="₹42.6L" />
    <x-stat-card label="New Enrollments" value="186" />
    <x-stat-card label="Closed Plans" value="42" />
</div>
<div class="card p-6 h-64 flex items-center justify-center text-ink-900/30 text-sm">[ Revenue Chart Placeholder ]</div>
@endsection
