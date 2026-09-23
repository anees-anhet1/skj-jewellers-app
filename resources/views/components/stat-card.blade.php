@props(['label' => '', 'value' => '', 'sub' => ''])
<div class="card p-6">
    <p class="text-xs uppercase tracking-wider text-ink-900/50 mb-2">{{ $label }}</p>
    <p class="text-2xl font-serif font-bold text-ink-900">{{ $value }}</p>
    @if($sub)<p class="text-xs text-gold-500 mt-1">{{ $sub }}</p>@endif
</div>
