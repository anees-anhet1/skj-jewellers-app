@props(['eyebrow' => '', 'title' => '', 'center' => false])
<div class="{{ $center ? 'text-center' : '' }} mb-10">
    @if($eyebrow)<p class="section-subtitle">{{ $eyebrow }}</p>@endif
    <h2 class="section-title">{{ $title }}</h2>
</div>
