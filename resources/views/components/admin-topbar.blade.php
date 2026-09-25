<header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-4 md:px-8 sticky top-0 z-40 shadow-sm">
    <h1 class="font-serif text-2xl font-semibold text-ink-900 tracking-wide">@yield('page-title', 'Admin Overview')</h1>
    <div class="flex items-center gap-5">
        @if($topbarRate)
        <div class="hidden sm:flex items-center gap-2 bg-gradient-to-r from-gold-50 to-white border border-gold-200 px-4 py-2 rounded-full text-xs shadow-sm">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
            <span class="font-medium text-ink-800">22K Rate: <span class="text-gold-600 font-bold ml-1">₹{{ number_format($topbarRate->rate_22k, 2) }}</span></span>
        </div>
        @endif
        <div class="relative hidden md:block">
            <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" placeholder="Search anything..." class="pl-11 pr-4 py-2.5 rounded-full border border-gray-200 bg-gray-50/50 text-sm w-72 focus:bg-white focus:outline-none focus:ring-2 focus:ring-gold-300 focus:border-transparent transition-all shadow-inner">
        </div>
        <button class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 hover:text-gold-500 hover:bg-gold-50 transition relative">
            <i class="bi bi-bell text-lg"></i>
            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
        </button>
        <div class="relative ml-2" x-data="{ open: false }">
            <button @click="open = !open" @click.outside="open = false"
                class="flex items-center gap-2 focus:outline-none">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-ink-800 to-ink-900 flex items-center justify-center text-gold-400 shadow-md">
                    <span class="font-serif font-bold text-sm">AD</span>
                </div>
                <i class="bi bi-chevron-down text-xs text-gray-400 hidden sm:block"></i>
            </button>

            <div x-show="open" x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-1"
                class="absolute right-0 mt-3 w-56 bg-white border border-gray-100 rounded-2xl shadow-xl overflow-hidden z-50">
                <div class="px-5 py-4 border-b border-gray-50 bg-gray-50/50">
                    <p class="text-sm font-semibold text-ink-900">Admin User</p>
                    <p class="text-xs text-gray-500 truncate mt-0.5">{{ auth()->user()->email ?? 'admin@vanand.com' }}</p>
                </div>
                <div class="p-2">
                    <a href="{{ url('/admin/settings') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-ink-700 rounded-lg hover:bg-gold-50 hover:text-gold-600 transition"><i class="bi bi-gear text-lg"></i> Settings</a>
                    <a href="{{ url('/logout') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium text-red-600 rounded-lg hover:bg-red-50 transition"><i class="bi bi-box-arrow-right text-lg"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>