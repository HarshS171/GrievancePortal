@props(['status'])

@php
    $class = match($status) {
        'Pending' => 'badge-pending',
        'In Progress' => 'badge-in-progress',
        'Resolved' => 'badge-resolved',
        'Rejected' => 'badge-rejected',
        default => 'badge bg-slate-100 text-slate-800 border-slate-200',
    };
@endphp

<span {{ $attributes->merge(['class' => $class]) }}>{{ $status }}</span>
