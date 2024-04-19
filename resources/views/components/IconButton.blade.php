@props(['icon', 'href'])

<a href="{{ $href }}" wire:navigate
    class="inline-flex items-center justify-center whitespace-nowrap font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 rounded-md px-3 text-xs h-7 gap-1">
    <iconify-icon icon="{{ $icon }}" class="text-lg"></iconify-icon>
    <span class="sr-only sm:not-sr-only sm:whitespace-nowrap">
        {{ $slot }}
    </span>
</a>
