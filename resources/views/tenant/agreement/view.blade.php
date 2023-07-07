@extends ('layouts.app')
@section('title', 'Acordos | Vizualizar')

@section('content')
    <div class="page-title-box">
        <div class="container xl justify-center items-center min-h-[640px]">
            <nav class="p-4">
                <ol class="list-reset flex gap-2">
                    <span class="material-icons text-base ">handshake</span>
                    <li><a href="{{route('agreement.index', session('tenant')['subdomain'])}}" class="text-whites hover:text-blue-700">Acordos</a></li>
                    <li><span class="text-white mx-2"> / </span></li>
                    <li class="text-gray-100">Vizualizar</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 md:grid-cols-12 justify-center items-start gap-5 px-4">
                <div class="md:col-span-12">
                    @livewire('tenant.agreement.show.card', ['reference' => $reference])
                </div>
            </div>
        </div>

@stop
