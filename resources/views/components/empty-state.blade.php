@props([
    'title',
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'card p-12 sm:p-16 text-center border-dashed border-2 border-slate-200 bg-slate-50/30']) }}>
    <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white mb-6 shadow-inner border border-slate-100">
        @if(isset($icon))
            {{ $icon }}
        @else
            <svg class="h-10 w-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        @endif
    </div>
    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $title }}</h3>
    @if($description)
        <p class="text-slate-500 font-medium max-w-md mx-auto mb-6">{{ $description }}</p>
    @endif
    @if(isset($action))
        <div class="mt-2">{{ $action }}</div>
    @endif
</div>
