<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    @vite(['resources/css/app.css', 'resources/js/app.js'])

{{--    @yield('scripts')--}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @livewireStyles

</head>

<body
        x-data="{ isMobileOpen: false }"
        class="relative flex flex-col min-h-screen antialiased overflow-x-hidden overscroll-contain bg-slate-50"
        @keydown.escape.window="isMobileOpen = false"
>
<x-notifications/>
<x-dialog z-index="z-50" blur="md" align="center" />
@include('includes.header')

@yield('content')

@include('includes.footer')

@livewire('components.open-modal')
@livewire('components.open-modal2')
@livewire('components.open-modal3')
@livewire('components.confirm-modal')
@livewire('components.central-modal')
{{--@livewire('notifications.read')--}}

@wireUiScripts
@livewireScripts

</body>
</html>

@stack('body-scripts')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


