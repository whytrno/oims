@props([
    'color' => 'primary',
    'width' => 'min',
    'action',
    'type' => 'button',
    'disabled' => auth()->user()->getRoleNames()->first() === 'admin' ? false : true,
])

@php
    $class =
        'md:col-span-2 inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 bg-primary hover:bg-primary/90';
@endphp

@if (isset($action))
    <a href="{{ route($action) }}" @class([
        $class,
        'w-min whitespace-nowrap' => $width === 'min',
        'w-full' => $width === 'full',
    ])>
        {{ $slot }}
    </a>
@else
    <button @class([
        $class,
        'w-min whitespace-nowrap' => $width === 'min',
        'w-full' => $width === 'full',
        'cursor-not-allowed' => $disabled,
    ]) type="{{ $type }}" @disabled($disabled)>
        {{ $slot }}
    </button>
@endif
