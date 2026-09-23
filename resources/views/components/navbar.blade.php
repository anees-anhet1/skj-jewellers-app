<header x-data="{ open:false, mega:false }" class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gold-100">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex items-center justify-between h-20">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <x-logo />
            </a>

            <nav class="hidden lg:flex items-center gap-8 text-sm font-medium text-ink-800">
                <a href="{{ url('/shop') }}" class="hover:text-gold-500 transition">Shop</a>
                <a href="{{ url('/collections') }}" class="hover:text-gold-500 transition">Collections</a>
                <a href="{{ url('/gold-saving-scheme') }}" class="hover:text-gold-500 transition">Gold Savings</a>
                <a href="{{ url('/offers') }}" class="hover:text-gold-500 transition">Offers</a>
                <a href="{{ url('/gold-rate') }}" class="hover:text-gold-500 transition">Gold Rate</a>
                <a href="{{ url('/store-locator') }}" class="hover:text-gold-500 transition">Stores</a>
                <a href="{{ url('/about') }}" class="hover:text-gold-500 transition">About</a>
                <a href="{{ url('/contact') }}" class="hover:text-gold-500 transition">Contact</a>
            </nav>

            <div class="hidden lg:flex items-center gap-3">
                <a href="{{ url('/book-appointment') }}" class="btn-outline !px-4 !py-2 text-xs">Book Appointment</a>
                <a href="{{ url('/dashboard') }}" class="btn-gold !px-4 !py-2 text-xs">My Account</a>
            </div>

            <button @click="open=!open" class="lg:hidden text-ink-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak class="lg:hidden border-t border-gold-100 bg-white">
        <div class="px-4 py-4 flex flex-col gap-3 text-sm font-medium">
            <a href="{{ url('/shop') }}">Shop</a>
            <a href="{{ url('/collections') }}">Collections</a>
            <a href="{{ url('/gold-saving-scheme') }}">Gold Savings</a>
            <a href="{{ url('/offers') }}">Offers</a>
            <a href="{{ url('/gold-rate') }}">Gold Rate</a>
            <a href="{{ url('/store-locator') }}">Stores</a>
            <a href="{{ url('/about') }}">About</a>
            <a href="{{ url('/contact') }}">Contact</a>
            <a href="{{ url('/book-appointment') }}" class="btn-outline mt-2 text-center">Book Appointment</a>
            <a href="{{ url('/dashboard') }}" class="btn-gold text-center">My Account</a>
        </div>
    </div>
</header>
