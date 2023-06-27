@extends ('layouts.app')
@section('title', 'Minhas Cobranças | Detalhes')

@section('content')
    <div class="page-title-box">
        <div class="container xl justify-center items-center min-h-[640px]">
            <nav class="py-5">
                <ol class="list-reset flex">
                    <li><a href="" class="text-whites hover:text-blue-700">Configurações</a></li>
                    <li><span class="text-white mx-2"> / </span></li>
                    <li class="text-gray-100">Gerais</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 md:grid-cols-12 justify-center items-start gap-5">
                <div class="md:col-span-4">
                    <div class="pb-5">
                        @livewire('vendor.configuration.logo')
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="pb-5">
                        @livewire('vendor.configuration.layout')
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="pb-5">
                        @livewire('vendor.configuration.data')
                    </div>
                </div>

            </div>
        </div>

@stop
