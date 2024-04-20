@props([
    'type' => 'button', // link, modalButton, iconButton
    'buttonType' => 'button',
    'width' => 'min',
    'href',
    'icon',
    'disabled' => auth()->user()->getRoleNames()->first() === 'admin' ? false : true,
    'modalComponent' => 'null',
    'arguments' => 'null',
])

@php
    $buttonClass =
        'md:col-span-2 inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 text-primary-foreground shadow h-9 px-4 py-2 bg-primary hover:bg-primary/90';
    $linkClass = 'border-b border-b-gray-400 border-dotted hover:border-b-black text-sm w-min whitespace-nowrap';
    $iconButtonClass =
        'inline-flex items-center justify-center whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 rounded-md px-3 text-xs h-7 gap-1';
    $modalButtonClass = 'border-b border-b-gray-400 border-dotted hover:border-b-black text-sm w-min whitespace-nowrap';
@endphp

@if ($type === 'link')
    <a href="{{ $href }}" wire:navigate @class([$linkClass])>
        {{ $slot }}
    </a>
@elseif($type === 'button')
    @php
        if ($buttonType !== 'submit') {
            $disabled = false;
        }
    @endphp

    <button type="{{ $buttonType }}" @disabled($disabled) @class([
        $buttonClass,
        'w-min whitespace-nowrap' => $width === 'min',
        'w-full' => $width === 'full',
        'cursor-not-allowed' => $disabled,
    ])>
        {{ $slot }}
    </button>
@elseif($type === 'buttonLink')
    <a href="{{ $href }}" @class([
        $buttonClass,
        'w-min whitespace-nowrap' => $width === 'min',
        'w-full' => $width === 'full',
    ])>
        {{ $slot }}
    </a>
@elseif ($type === 'iconButton')
    <a href="{{ $href }}" wire:navigate @class([$iconButtonClass])>
        <iconify-icon icon="{{ $icon }}" class="text-lg"></iconify-icon>
        <span class="sr-only sm:not-sr-only sm:whitespace-nowrap">
            {{ $slot }}
        </span>
    </a>
@elseif($type === 'modalButton')
    <button type="button"
        wire:click="$dispatch('openModal', { component: '{{ $modalComponent }}', arguments: {{ $arguments }}})"
        @class([$modalButtonClass])>
        {{ $slot }}
    </button>
@endif
