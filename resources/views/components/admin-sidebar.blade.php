@php
$links = [
    ['Overview', '/admin', 'bi-grid'],
    ['Customers', '/admin/customers', 'bi-people'],
    ['Plans & Schemes', '/admin/plans', 'bi-journal-richtext'],
    ['Payments', '/admin/payments', 'bi-credit-card'],
    ['Appointments', '/admin/appointments', 'bi-calendar-check'],
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
            <div class="font-serif text-2xl font-bold tracking-widest text-gold-400">V. ANAND<span class="text-white">.</span></div>
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
        <div class="bg-gradient-to-br from-gold-400/10 to-gold-500/5 border border-gold-500/20 rounded-xl p-4 flex items-start gap-3">
            <i class="bi bi-shield-check text-gold-400 text-xl"></i>
            <div>
                <h4 class="text-sm font-medium text-white mb-1">Secure Session</h4>
                <p class="text-[10px] text-white/50 leading-relaxed">Connected to 256-bit encrypted portal.</p>
            </div>
        </div>
    </div>
</aside>

<style>
.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>
