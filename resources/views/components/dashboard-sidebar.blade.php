@php
$links = [
    ['Dashboard', '/dashboard', 'home'],
    ['My Plans', '/dashboard/my-plans', 'plans'],
    ['Join New Plan', '/dashboard/new-plan', 'new'],
    ['Payment History', '/dashboard/payment-history', 'history'],
    ['Gold Weight', '/dashboard/gold-weight', 'weight'],
    ['Closed Plans', '/dashboard/closed-plans', 'closed'],
    ['Notifications', '/dashboard/notifications', 'bell'],
    ['Profile', '/dashboard/profile', 'profile'],
];
@endphp
<aside x-cloak :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed lg:static lg:translate-x-0 z-40 transition-transform w-72 bg-ink-900 text-white min-h-screen p-6">
    <a href="{{ url('/') }}" class="flex items-center gap-3 mb-10">
        <x-logo variant="light" />
    </a>
    <nav class="space-y-1 text-sm">
        @foreach($links as [$label, $href, $icon])
            <a href="{{ url($href) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->is(ltrim($href,'/')) ? 'bg-gold-500 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }} transition">
                <span class="w-2 h-2 rounded-full bg-gold-400"></span>
                {{ $label }}
            </a>
        @endforeach
    </nav>
    <div class="mt-10 p-4 rounded-xl bg-gradient-to-br from-gold-500 to-gold-600 text-xs">
        <p class="font-semibold mb-1">Gold Rate Today</p>
        <p class="text-lg font-serif font-bold">₹6,589.23 <span class="text-xs font-normal">/gm (22K)</span></p>
    </div>
</aside>
