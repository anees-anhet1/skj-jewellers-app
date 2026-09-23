@props([
    'brand' => config('brand.name'),
    'gold22k' => '13,725.00',
    'silver' => '250.00',
])

<div {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl shadow-md border border-gold-200/80']) }}>
    <div class="flex items-center gap-4 px-4 py-3 md:px-5 md:py-4 bg-[#2e2a5f]">
        <p class="text-sm md:text-base font-semibold text-white/95 shrink-0 max-w-[8.5rem] leading-snug">{{ $brand }}</p>
        <div class="flex-1 text-right min-w-0">
            <p class="text-[#f0c14b] font-bold uppercase tracking-wide text-sm md:text-base leading-tight">Today&apos;s Rate</p>
            <p class="text-[#f0c14b] uppercase text-xs md:text-sm font-medium mt-0.5">Rs {{ $gold22k }}/Gram</p>
        </div>
    </div>
    <div class="bg-white px-4 py-3 md:px-5 md:py-4">
        <p class="font-bold text-[#a67c00] text-sm md:text-base pb-3 mb-3 border-b border-dashed border-gray-300">
            Gold 22K : Rs {{ $gold22k }}/Gram
        </p>
        <p class="font-bold text-[#a67c00] text-sm md:text-base">
            Silver : Rs {{ $silver }}/Gram
        </p>
    </div>
</div>
