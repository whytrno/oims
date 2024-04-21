@props(['src' => null, 'fallback' => '', 'size' => 14])

<span class="relative flex shrink-0 overflow-hidden rounded-full cursor-pointer size-{{ $size }}">
    @if ($src)
        @if (!is_string($src))
            <img class="aspect-square size-14 rounded-full object-cover border" alt="Foto"
                src="{{ $src->temporaryUrl() }}">
        @else
            <img class="aspect-square size-14 rounded-full object-cover border" alt="Foto" src="{{ $src }}">
        @endif
    @else
        @php
            $namaExplode = explode(' ', $fallback);
            $fallback = $namaExplode[0][0];
        @endphp
        <div class="h-full w-full rounded-full flex items-center justify-center bg-gray-200 text-gray-600 font-semibold">
            {{ ucfirst($fallback) }}
        </div>
    @endif
</span>
