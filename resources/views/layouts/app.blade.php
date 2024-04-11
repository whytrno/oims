<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
    @vite('resources/js/app.js')
</head>

<body class="min-h-screen bg-background font-sans antialiased">
    @yield('content')

    @stack('scripts')
</body>

</html>
