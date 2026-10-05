@php
$links = [
    ['Overview', '/admin', 'bi-grid'],
    ['Customers', '/admin/customers', 'bi-people'],
    ['Plans & Schemes', '/admin/plans', 'bi-journal-richtext'],
    ['Payments', '/admin/payments', 'bi-credit-card'],
    ['Appointments', '/admin/appointments', 'bi-calendar-check'],
    ['Messages', '/admin/contact-messages', 'bi-envelope'],
    ['Products', '/admin/products', 'bi-box-seam'],
    ['Collections', '/admin/collections', 'bi-collection'],
    ['Offers', '/admin/offers', 'bi-tags'],
    ['Gold Rate', '/admin/gold-rate', 'bi-graph-up-arrow'],
    ['Reports', '/admin/reports', 'bi-file-earmark-bar-graph'],
    ['Settings', '/admin/settings', 'bi-gear'],
];
@endphp
<aside class="w-72 min-h-screen bg-ink-900 flex-col hidden lg:flex relative overflow-hidden shadow-2xl z-50">
    <div class="absolute top-0 right-0 w-64 h-64 bg-gold-500/10 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>
    
    <div class="p-8 pb-6 border-b border-white/5 relative z-10">
        <a href="{{ url('/admin') }}" class="block">
            <div class="font-serif text-2xl font-bold tracking-widest text-gold-400">V. ANAND</div>
            <div class="text-[10px] tracking-[0.4em] text-white/40 uppercase mt-1">Admin Portal</div>
        </a>
    </div>
    
    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5 relative z-10 scrollbar-hide">
        <div class="text-xs font-semibold text-white/30 uppercase tracking-[0.2em] mb-4 pl-4">Menu</div>
        @foreach($links as [$label, $href, $icon])
            <a href="{{ url($href) }}" class="flex items-center gap-4 px-4 py-3 rounded-xl transition duration-300 {{ request()->is(ltrim($href,'/')) ? 'bg-gradient-to-r from-gold-400 to-gold-500 text-white shadow-luxe font-medium' : 'text-white/60 hover:text-white hover:bg-white/5' }}">
                <i class="bi {{ $icon }} text-lg {{ request()->is(ltrim($href,'/')) ? 'text-white' : 'text-gold-400/70' }}"></i>
                {{ $label }}
            </a>
        @endforeach
    </nav>
    
    <div class="p-6 border-t border-white/5 relative z-10">
        <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gold-400 to-gold-600 flex flex-shrink-0 items-center justify-center text-white font-serif font-bold shadow-md">
                AD
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-sm font-medium text-white truncate">Administrator</h4>
                <p class="text-[10px] text-white/50 truncate">{{ auth()->user()->email ?? 'admin@vanand.com' }}</p>
            </div>
            <a href="{{ url('/logout') }}" class="w-8 h-8 rounded-lg bg-red-500/10 text-red-400 flex items-center justify-center hover:bg-red-500 hover:text-white transition flex-shrink-0" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </div>
</aside>

<style>
.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>
