@php
$links = [
    ['Overview', '/admin', 'overview'],
    ['Customers', '/admin/customers', 'customers'],
    ['Plans & Schemes', '/admin/plans', 'plans'],
    ['Payments', '/admin/payments', 'payments'],
    ['Appointments', '/admin/appointments', 'appointments'],
    ['Products', '/admin/products', 'products'],
    ['Collections', '/admin/collections', 'collections'],
    ['Offers', '/admin/offers', 'offers'],
    ['Gold Rate', '/admin/gold-rate', 'rate'],
    ['Reports', '/admin/reports', 'reports'],
    ['Settings', '/admin/settings', 'settings'],
];
@endphp
<aside class="w-72 min-h-screen bg-white border-r border-gold-100 p-6 hidden lg:block">
    <a href="{{ url('/') }}" class="flex items-center gap-3 mb-10">
        <x-logo />
    </a>
    <nav class="space-y-1 text-sm">
        @foreach($links as [$label, $href, $icon])
            <a href="{{ url($href) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->is(ltrim($href,'/')) ? 'bg-ink-900 text-white' : 'text-ink-800/70 hover:bg-gold-50' }} transition">
                <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                {{ $label }}
            </a>
        @endforeach
    </nav>
</aside>
