@props(['type' => 'link', 'route' => 'null', 'modalComponent' => 'null', 'arguments' => 'null'])

@if ($type === 'link')
    <a href="{{ $route }}" wire:navigate
        class="text-sm border-b-2 border-dotted border-gray-300 hover:border-gray-700 transition-all">
        {{ $slot }}
    </a>
@elseif($type === 'modalButton')
    <button type="button"
        wire:click="$dispatch('openModal', { component: '{{ $modalComponent }}', arguments: {{ $arguments }}})"
        class="border-b border-b-gray-400 border-dotted hover:border-b-black text-sm w-min whitespace-nowrap">
        {{ $slot }}
    </button>
@endif
