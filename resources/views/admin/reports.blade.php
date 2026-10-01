@extends('layouts.admin')
@section('page-title','Reports')
@section('content')
<div class="grid md:grid-cols-3 gap-6 mb-8">
    <x-stat-card label="This Month Revenue" value="₹{{ number_format($revenueThisMonth) }}" />
    <x-stat-card label="New Enrollments" value="{{ $newEnrollments }}" />
    <x-stat-card label="Closed Plans" value="{{ $closedPlans }}" />
</div>
<div class="card p-6 h-96">
    <canvas id="revenueChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const rawData = @json($dailyRevenue);
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: rawData.map(d => d.date),
            datasets: [{
                label: 'Daily Revenue (₹)',
                data: rawData.map(d => d.total),
                borderColor: '#d4af37',
                backgroundColor: 'rgba(212,175,55,0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
