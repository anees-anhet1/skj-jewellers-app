<header class="h-20 bg-white border-b border-gold-100 flex items-center justify-between px-4 md:px-8">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-ink-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
        </button>
        <h1 class="font-serif text-xl font-semibold text-ink-900">@yield('page-title', 'Dashboard')</h1>
    </div>
    <div class="flex items-center gap-4">
        <!-- Live Daily Gold Rate Badge -->
        @if($topbarRate)
        <div class="hidden sm:flex items-center gap-3 bg-gold-50 border border-gold-200 px-3 py-1.5 rounded-full text-xs">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="font-semibold text-ink-900">22K Gold: <span class="text-gold-600 font-bold">₹{{ number_format($topbarRate->rate_22k, 2) }}/gm</span></span>
            <span class="text-ink-900/40">| {{ date('d M Y') }}</span>
        </div>
        @endif
        <a href="{{ url('/dashboard/notifications') }}" class="w-10 h-10 rounded-full bg-gold-50 hover:bg-gold-100 transition flex items-center justify-center text-gold-600">🔔</a>
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.outside="open = false"
                class="w-10 h-10 rounded-full border border-gold-300 bg-gold-100 text-gold-700 font-semibold text-sm flex items-center justify-center"
                title="{{ config('brand.name') }}">
                VA
            </button>

            <div x-show="open" x-cloak
                class="absolute right-0 mt-2 w-40 bg-white border border-gold-100 rounded-xl shadow-luxe overflow-hidden z-50">
                <a href="{{ url('/dashboard/profile') }}" class="block px-4 py-2 text-sm text-ink-900 hover:bg-gold-50">Profile</a>
                <a href="{{ url('/logout') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gold-50">Logout</a>
            </div>
        </div>
    </div>
</header>