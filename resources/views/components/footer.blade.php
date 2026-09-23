<footer class="bg-ink-900 text-white mt-24">
    <div class="max-w-7xl mx-auto px-4 md:px-8 py-16 grid grid-cols-1 md:grid-cols-4 gap-10">
        <div>
            <div class="flex items-center gap-3 mb-4">
                <x-logo variant="on-dark" />
            </div>
            <p class="text-sm text-white/60 mb-3">Crafting timeless jewellery and trusted gold savings plans since generations.</p>
            <p class="text-sm text-white/70">📍 Chickpet, Bengaluru, Karnataka</p>
        </div>
        <div>
            <h4 class="font-serif text-gold-400 mb-4">Explore</h4>
            <ul class="space-y-2 text-sm text-white/70">
                <li><a href="{{ url('/shop') }}" class="hover:text-gold-400">Shop Jewellery</a></li>
                <li><a href="{{ url('/collections') }}" class="hover:text-gold-400">Collections</a></li>
                <li><a href="{{ url('/gold-saving-scheme') }}" class="hover:text-gold-400">Gold Savings Scheme</a></li>
                <li><a href="{{ url('/offers') }}" class="hover:text-gold-400">Offers</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-serif text-gold-400 mb-4">Company</h4>
            <ul class="space-y-2 text-sm text-white/70">
                <li><a href="{{ url('/about') }}" class="hover:text-gold-400">About Us</a></li>
                <li><a href="{{ url('/store-locator') }}" class="hover:text-gold-400">Store Locator</a></li>
                <li><a href="{{ url('/book-appointment') }}" class="hover:text-gold-400">Book Appointment</a></li>
                <li><a href="{{ url('/contact') }}" class="hover:text-gold-400">Contact</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-serif text-gold-400 mb-4">Get in touch</h4>
            <p class="text-sm text-white/70">{{ config('brand.phone') }}</p>
            <p class="text-sm text-white/70 mb-4">{{ config('brand.email') }}</p>
            <div class="flex gap-3">
                <span class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center text-xs">FB</span>
                <span class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center text-xs">IG</span>
                <span class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center text-xs">YT</span>
            </div>
        </div>
    </div>
    <div class="border-t border-white/10 py-6 text-center text-xs text-white/40">
        © {{ date('Y') }} {{ config('brand.name') }}. All rights reserved. · UI demo only
    </div>
</footer>
