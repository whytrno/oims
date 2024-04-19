@props([
    'pageTitleActions' => null,
])

<div class="flex justify-between items-center">
    <div class="flex flex-col gap-1">
        @php
            $path = Request::path();
            $path = explode('/', $path);
            $path = array_filter($path, function ($value) {
                return !is_numeric($value);
            });
            $path = array_values($path);

            if ($path[0] === '') {
                array_shift($path);
            }
            $lastPath = $path[0] !== '' ? end($path) : 'Dashboard';
        @endphp

        <h1 class="text-lg font-semibold md:text-2xl">{{ ucfirst($lastPath) }}</h1>
        <nav aria-label="breadcrumb" class="flex">
            <ol class="flex flex-wrap items-center gap-1.5 break-words text-sm text-muted-foreground sm:gap-2.5">
                <li class="flex items-center gap-1.5 cursor-pointer">
                    <a class="transition-colors flex items-center hover:text-foreground" href="{{ route('dashboard') }}">
                        <iconify-icon icon="mdi:home" observer="false"></iconify-icon>
                    </a>
                </li>
                <iconify-icon icon="mdi:chevron-right"></iconify-icon>

                @foreach ($path as $index => $item)
                    @if ($index === count($path) - 1)
                        <li class="inline-flex items-center gap-1.5">
                            <span>{{ ucfirst($item) }}</span>
                        </li>
                        @continue
                    @endif
                    <li class="inline-flex items-center gap-1.5">
                        <a class="transition-colors hover:text-foreground"
                            href="/{{ $item }}">{{ ucfirst($item) }}</a>
                    </li>
                    <iconify-icon icon="mdi:chevron-right"></iconify-icon>
                @endforeach
            </ol>
        </nav>
    </div>

    {{-- @yield('page-title-actions') --}}
    {{ $pageTitleActions }}
</div>
