@props(['name' => 'Gold Premium Necklace', 'price' => '₹62,000', 'mrp' => '₹72,000', 'tag' => null, 'image' => null])
<div class="card group">
    <div class="relative aspect-square bg-gradient-to-br from-gold-50 to-gold-100 overflow-hidden flex items-center justify-center">
        @if($tag)
            <span class="absolute top-3 left-3 z-10 bg-ink-900 text-white text-[10px] tracking-widest uppercase px-3 py-1 rounded-full shadow">{{ $tag }}</span>
        @endif
        <span class="absolute top-3 right-3 z-10 w-9 h-9 rounded-full bg-white/80 backdrop-blur flex items-center justify-center text-gold-500 hover:bg-gold-500 hover:text-white transition cursor-pointer z-20">♥</span>
        
        @if($image)
            <img src="{{ asset('storage/' . $image) }}" alt="{{ $name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @else
            <img src="{{ asset('images/necklace.png') }}" alt="{{ $name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-60">
        @endif

        <!-- Quick Add Overlay -->
        <div class="absolute inset-x-0 bottom-0 p-4 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-20">
            <button onclick="event.preventDefault();" class="w-full bg-white/90 backdrop-blur text-ink-900 font-semibold py-2.5 rounded-full text-xs uppercase tracking-wider hover:bg-gold-400 hover:text-white transition-colors shadow-lg">Quick Add</button>
        </div>
    </div>
    <div class="p-4 bg-white relative z-10">
        <p class="text-xs text-gold-500 uppercase tracking-wider mb-1">{{ $slot->isEmpty() ? 'Category' : $slot }}</p>
        <h3 class="font-serif font-semibold text-ink-900 mb-1 truncate">{{ $name }}</h3>
        <div class="flex items-center gap-2">
            <span class="font-semibold text-ink-900">₹{{ number_format((float)$price, 2) }}</span>
        </div>
    </div>
</div>
