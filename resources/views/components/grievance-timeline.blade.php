@props(['status'])

@php
    $steps = [
        ['label' => 'Submitted', 'desc' => 'Your grievance has been received'],
        ['label' => 'Under Review', 'desc' => 'Assigned to dealing officer'],
        ['label' => 'Resolved', 'desc' => 'Official resolution provided'],
    ];

    if ($status === 'Rejected') {
        $steps[1] = ['label' => 'Rejected', 'desc' => 'Case closed by administration'];
    }

    $activeStep = match($status) {
        'Pending' => 1,
        'In Progress' => 2,
        'Resolved' => 4,
        'Rejected' => 2,
        default => 1,
    };
@endphp

<div {{ $attributes->merge(['class' => 'card p-6 sm:p-8']) }}>
    <h4 class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-6">Resolution Progress</h4>
    <ol class="relative">
        @foreach($steps as $index => $step)
            @php
                $stepNum = $index + 1;
                $isComplete = $stepNum < $activeStep;
                $isCurrent = $stepNum === $activeStep && $status !== 'Resolved';
            @endphp
            <li class="relative flex gap-4 {{ !$loop->last ? 'pb-8' : '' }}">
                @if(!$loop->last)
                    <div class="absolute left-5 top-10 bottom-0 w-0.5 {{ $isComplete ? 'bg-emerald-300' : 'bg-slate-200' }}"></div>
                @endif
                <div class="relative z-10 w-10 h-10 rounded-xl flex items-center justify-center shrink-0 border-2 transition-all
                    {{ $isComplete ? 'bg-emerald-500 border-emerald-500 text-white shadow-md shadow-emerald-200' : '' }}
                    {{ $isCurrent ? ($status === 'Rejected' ? 'bg-rose-600 border-rose-600 text-white ring-4 ring-rose-100' : 'bg-portal-900 border-portal-900 text-white ring-4 ring-portal-100') : '' }}
                    {{ !$isComplete && !$isCurrent ? 'bg-white border-slate-200 text-slate-400' : '' }}">
                    @if($isComplete)
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    @else
                        <span class="text-xs font-bold">{{ $stepNum }}</span>
                    @endif
                </div>
                <div class="pt-1.5">
                    <p class="text-sm font-bold {{ $isCurrent ? ($status === 'Rejected' ? 'text-rose-800' : 'text-portal-900') : 'text-slate-800' }}">{{ $step['label'] }}</p>
                    <p class="text-xs font-medium text-slate-500 mt-0.5">{{ $step['desc'] }}</p>
                    @if($isCurrent)
                        <span class="inline-flex mt-2 items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider {{ $status === 'Rejected' ? 'bg-rose-50 text-rose-800 border border-rose-100' : 'bg-portal-50 text-portal-800 border border-portal-100' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $status === 'Rejected' ? 'bg-rose-500' : 'bg-emerald-500' }} animate-pulse"></span>
                            Current
                        </span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</div>
