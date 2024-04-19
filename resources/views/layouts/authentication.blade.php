<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
    <title>OimsApps</title>
    @vite('resources/js/app.js')
    @livewireStyles
</head>

<body>
    {{ $slot }}

    <x-toaster-hub />

    {{-- SCRIPTS --}}
    @livewireScripts
</body>

</html>
