@props(['eyebrow' => '', 'title' => '', 'center' => false])
<div {{ $attributes->merge(['class' => ($center ? 'text-center ' : '') . 'mb-10']) }}>
    @if($eyebrow)<p class="section-subtitle">{{ $eyebrow }}</p>@endif
    <h2 class="section-title">{{ $title }}</h2>
</div>