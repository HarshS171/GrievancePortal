@props([
    'label',
    'value',
    'icon' => null,
    'accent' => 'portal',
    'description' => null,
])

@php
    $accents = [
        'portal' => ['bg' => 'bg-portal-50', 'text' => 'text-portal-700', 'border' => 'border-portal-100/60', 'blob' => 'bg-portal-50'],
        'emerald' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border-emerald-100/60', 'blob' => 'bg-emerald-50'],
        'amber' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border-amber-100/60', 'blob' => 'bg-amber-50'],
        'sky' => ['bg' => 'bg-sky-50', 'text' => 'text-sky-700', 'border' => 'border-sky-100/60', 'blob' => 'bg-sky-50'],
        'blue' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border-blue-100/60', 'blob' => 'bg-blue-50'],
    ];
    $a = $accents[$accent] ?? $accents['portal'];
@endphp

<div {{ $attributes->merge(['class' => 'card p-6 relative overflow-hidden group hover:-translate-y-0.5 transition-transform duration-300']) }}>
    <div class="absolute right-0 top-0 w-28 h-28 {{ $a['blob'] }} rounded-bl-full -mr-12 -mt-12 opacity-80 group-hover:scale-110 transition-transform"></div>
    <div class="relative z-10 flex items-center gap-4">
        @if($icon)
            <div class="p-3.5 rounded-2xl {{ $a['bg'] }} {{ $a['text'] }} border {{ $a['border'] }} shadow-sm">
                {!! $icon !!}
            </div>
        @endif
        <div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">{{ $label }}</p>
            <p class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">{{ $value }}</p>
            @if($description)
                <p class="mt-1 text-sm font-medium text-slate-500">{{ $description }}</p>
            @endif
        </div>
    </div>
</div>
