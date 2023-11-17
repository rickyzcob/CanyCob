<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('favicon/favicon-16x16.png')}}">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
{{--    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">--}}
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" ></script>


    @livewireStyles

    <style>
        :root{
            --user-primary-color: hsl({{ session('tenant')['color'] }});
            --text-primary-color: hsl({{ session('tenant')['text_color'] }});
        }

        body {
            font-family: 'Nunito', sans-serif;
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

@if(auth()->user()->type  == "Colaborador")
@livewire('tenant.dashboard.humor.button')
@endif

@yield('content')

@include('includes.footer')

@livewire('components.left-modal')
@livewire('components.open-modal')
@livewire('components.open-modal2')
@livewire('components.open-modal3')
@livewire('components.confirm-modal')
@livewire('components.central-modal')

@wireUiScripts
@livewireScripts

</body>
</html>

@stack('scripts')

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="{{url('js/sortable.js')}}"></script>


