<div class="flex flex-1 items-center justify-center rounded-lg border border-dashed shadow-sm">
    <div class="flex flex-col items-center gap-1 text-center">
        <h3 class="text-2xl font-bold tracking-tight">
            {{ $title }}
        </h3>
        <p class="text-sm text-muted-foreground">{{ $description }}</p>
        @if (isset($action) && isset($actionTitle))
            <a href="{{ route($action) }}"
                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground shadow hover:bg-primary/90 h-9 px-4 py-2 mt-4">
                {{ $actionTitle }}
            </a>
        @endif
    </div>
</div>
