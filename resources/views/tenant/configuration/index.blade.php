@extends ('layouts.app')
@section('title', 'Minhas Cobranças | Detalhes')

@section('content')
    <div class="page-title-box">
        <div class="container xl justify-center items-center min-h-[640px]">
            <nav class="p-4">
                <ol class="list-reset flex gap-2">
                    <span class="material-icons text-base ">settings_applications</span>
                    <li><a href="" class="text-whites hover:text-blue-700">Configurações</a></li>
                    <li><span class="text-white mx-2"> / </span></li>
                    <li class="text-gray-100">Parametros</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 md:grid-cols-12 justify-center items-start gap-5 px-3">
                <div class="md:col-span-12">
                    <div class="pb-5">
                        @livewire('vendor.configuration.tabs')
                    </div>
                </div>
            </div>
        </div>

@stop
