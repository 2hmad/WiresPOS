<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WiresPOS - Point of sale solution</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="/favicon.ico">
    {{-- <link rel="preload" href="https://fonts.googleapis.com" as="font">
    <link rel="preload" href="https://fonts.gstatic.com" crossorigin as="font"> --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&family=Poppins:wght@400;500;700&display=swap"
        rel="stylesheet" fetchpriority="low">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#369">
</head>

<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <!-- Scripts -->
    <script>
        if ("serviceWorker" in navigator) {
            window.addEventListener("load", () => {
                navigator.serviceWorker.register("/service-worker.js").then(swRegistered => {
                    console.log("[ServiceWorker**] - Registered");
                });
            });
        }
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
