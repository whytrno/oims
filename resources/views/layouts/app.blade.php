@props([
    'pageTitleActions' => null,
])

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
    <title>OimsApps</title>
    @vite('resources/js/app.js')
    @livewireStyles
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
</head>

<body>
    <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
        {{-- SIDEBAR --}}
        <x-sidebar />
        <div class="flex flex-col">
            {{-- NAVBAR --}}
            <x-navbar />
            <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6 w-screen lg:w-full">
                {{-- PAGE TITLE --}}
                <x-pageTitle :pageTitleActions="$pageTitleActions" />

                {{-- MAIN --}}
                @if ($slot->isEmpty())
                    This is default content if the slot is empty.
                @else
                    {{ $slot }}
                @endif
            </main>
        </div>
    </div>

    <x-toaster-hub />

    {{-- MODAL --}}
    {{-- <x-showImage @showModal="showModal($event)" /> --}}

    @livewire('wire-elements-modal')

    {{-- SCRIPTS --}}
    @livewireScripts
    @stack('scripts')
</body>

</html>
