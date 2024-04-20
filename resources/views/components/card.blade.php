@props(['title', 'description' => null, 'footer' => null, 'class' => 'lg:col-span-3'])

<div @class([
    $class,
    'col-span-6 p-4 rounded-lg border border-dashed shadow-sm space-y-2',
])>
    <h1 class="font-semibold">{{ $title }}</h1>
    @if ($description)
        <p class="text-xs text-gray-500">*{{ $description }}</p>
    @endif
    {{ $slot }}
    @if ($footer)
        {{ $footer }}
    @endif
</div>
