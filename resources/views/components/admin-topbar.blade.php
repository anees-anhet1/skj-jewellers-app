<header class="h-20 bg-white border-b border-gold-100 flex items-center justify-between px-4 md:px-8">
    <h1 class="font-serif text-xl font-semibold text-ink-900">@yield('page-title', 'Admin Overview')</h1>
    <div class="flex items-center gap-4">
        @if($topbarRate)
        <div class="hidden sm:flex items-center gap-2 bg-gold-50 border border-gold-200 px-3 py-1.5 rounded-full text-xs">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="font-semibold text-ink-900">22K: <span class="text-gold-600 font-bold">₹{{ number_format($topbarRate->rate_22k, 2) }}</span></span>
        </div>
        @endif
        <input type="text" placeholder="Search..." class="hidden md:block px-4 py-2 rounded-full border border-gold-100 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-gold-300">
        <span class="w-10 h-10 rounded-full bg-gold-50 flex items-center justify-center text-gold-500">🔔</span>
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.outside="open = false"
                class="w-10 h-10 rounded-full bg-gradient-to-br from-gold-300 to-gold-500">
            </button>

            <div x-show="open" x-cloak
                class="absolute right-0 mt-2 w-40 bg-white border border-gold-100 rounded-xl shadow-luxe overflow-hidden z-50">
                <a href="{{ url('/admin/settings') }}" class="block px-4 py-2 text-sm text-ink-900 hover:bg-gold-50">Settings</a>
                <a href="{{ url('/logout') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gold-50">Logout</a>
            </div>
        </div>
    </div>
</header>