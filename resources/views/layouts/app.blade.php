<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">

{{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5"></script>
{{--    <script src="https://unpkg.com/@jaames/iro@beta/dist/iro.js"></script>--}}
{{--    <script src="{{url('js/iro.js')}}"></script>--}}





    @livewireStyles

    <style>
        :root{
            --user-primary-color: hsl({{ session('tenant')['color'] }});
            --text-primary-color: hsl({{ session('tenant')['text_color'] }});
        }

        body {
            font-family: 'Heebo', sans-serif;
        }
    </style>

</head>

<body
        x-data="{ isMobileOpen: false }"
        class="flex flex-col min-h-screen antialiased overflow-x-hidden overscroll-contain bg-slate-50"
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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script src="{{url('js/sortable.js')}}"></script>


