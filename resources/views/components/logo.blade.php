@props(['variant' => 'default'])

@php
$nameClass = match ($variant) {
    'light', 'on-dark' => 'text-gold-400',
    default => 'text-gold-600',
};
$subClass = match ($variant) {
    'light', 'on-dark' => 'text-white/90',
    default => 'text-ink-900',
};
@endphp

<div {{ $attributes->merge(['class' => 'leading-tight select-none']) }}>
    <span class="block font-serif text-lg md:text-xl font-bold tracking-tight {{ $nameClass }}" style="font-family: 'Playfair Display', Georgia, serif;">
        {{ config('brand.name_primary') }}
    </span>
    <span class="block text-[11px] font-bold tracking-[0.2em] uppercase {{ $subClass }}">
        {{ config('brand.name_secondary') }}
    </span>
</div>
