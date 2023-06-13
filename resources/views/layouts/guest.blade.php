<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @livewireStyles
    @wireUiScripts

    <link href="{{url('css/style.css')}}" rel="stylesheet" type="text/css">

{{--    <!-- Scripts -->--}}
{{--        <link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
{{--        <script src="{{ mix('js/app.js') }}" defer></script>--}}

    @vite('resources/css/app.css')
</head>
<body>

@yield('content')



@livewireScripts

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
