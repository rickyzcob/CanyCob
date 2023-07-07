<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @livewireStyles
    @wireUiScripts

    <link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">

{{--    <link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
{{--    <script src="{{ mix('js/app.js') }}" defer></script>--}}


        @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        :root{
            --user-primary-color: hsl({{ session('tenant')['color'] }});
            --text-primary-color: hsl({{ session('tenant')['text_color'] }});
        }
        body {
            font-family: 'Heebo', sans-serif;
        }
    </style>


{{--    <!-- Scripts -->--}}
{{--        <link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
{{--        <script src="{{ mix('js/app.js') }}" defer></script>--}}


</head>
<body>

@yield('content')

@livewireScripts

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>
</html>
