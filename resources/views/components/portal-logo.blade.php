@props(['size' => 'md', 'showText' => true, 'href' => null])

@php
    $sizes = [
        'sm' => ['box' => 'w-8 h-8 rounded-lg', 'icon' => 'w-4 h-4', 'text' => 'text-base'],
        'md' => ['box' => 'w-10 h-10 rounded-xl', 'icon' => 'w-5 h-5', 'text' => 'text-lg'],
        'lg' => ['box' => 'w-14 h-14 rounded-2xl', 'icon' => 'w-7 h-7', 'text' => 'text-xl'],
    ];
    $s = $sizes[$size] ?? $sizes['md'];
    $wrapperClass = 'group flex items-center gap-3';
@endphp

@if($href)
<a href="{{ $href }}" {{ $attributes->merge(['class' => $wrapperClass]) }}>
@else
<div {{ $attributes->merge(['class' => $wrapperClass]) }}>
@endif
    <div class="{{ $s['box'] }} bg-gradient-to-br from-portal-800 to-portal-950 text-white flex items-center justify-center shadow-lg shadow-portal-900/30 group-hover:scale-105 transition-transform duration-300">
        <svg class="{{ $s['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
        </svg>
    </div>
    @if($showText)
        <div class="flex flex-col">
            <span class="{{ $s['text'] }} font-extrabold text-slate-900 tracking-tight leading-none">GrievancePortal</span>
            <span class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest mt-0.5 hidden sm:block">Citizen Redressal</span>
        </div>
    @endif
@if($href)
</a>
@else
</div>
@endif
