<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js"></script>
    <title>OimsApps</title>
    <script defer src="https://unpkg.com/alpinejs@3.13.8/dist/cdn.min.js"></script>
    @vite('resources/js/app.js')
</head>

<body class="min-h-screen bg-background font-sans antialiased">

@yield('content')

{{-- TOAST --}}
@if (session()->has('toast_message'))
    <div id="toast-message"
         class="fixed bottom-10 right-10 animate-in slide-in-from-bottom md:w-1/4 p-5 bg-white border shadow-sm rounded-lg">
        <p>
            {{ session('toast_message') }}
        </p>
    </div>
@endif

@stack('scripts')

<script>
    setTimeout(function () {
        var toastMessage = document.getElementById('toast-message');
        if (toastMessage) {
            toastMessage.remove();
        }
    }, 2000);
</script>
</body>

</html>
