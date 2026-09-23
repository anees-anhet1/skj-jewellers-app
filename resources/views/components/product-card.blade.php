@props(['name' => 'Gold Premium Necklace', 'price' => '₹62,000', 'mrp' => '₹72,000', 'tag' => null, 'image' => null])
<div class="card group">
    <div class="relative aspect-square bg-gradient-to-br from-gold-50 to-gold-100 overflow-hidden flex items-center justify-center">
        @if($tag)
            <span class="absolute top-3 left-3 z-10 bg-ink-900 text-white text-[10px] tracking-widest uppercase px-3 py-1 rounded-full shadow">{{ $tag }}</span>
        @endif
        <span class="absolute top-3 right-3 z-10 w-9 h-9 rounded-full bg-white/80 backdrop-blur flex items-center justify-center text-gold-500 hover:bg-gold-500 hover:text-white transition cursor-pointer">♥</span>
        <img src="{{ asset('images/' . ($image ?? 'necklace.png')) }}" alt="{{ $name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
    </div>
    <div class="p-4">
        <p class="text-xs text-gold-500 uppercase tracking-wider mb-1">{{ $slot->isEmpty() ? 'Necklace' : $slot }}</p>
        <h3 class="font-serif font-semibold text-ink-900 mb-1">{{ $name }}</h3>
        <div class="flex items-center gap-2">
            <span class="font-semibold text-ink-900">{{ $price }}</span>
            <span class="text-xs text-ink-900/40 line-through">{{ $mrp }}</span>
        </div>
    </div>
</div>
