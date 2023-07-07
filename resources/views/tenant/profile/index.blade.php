@extends ('layouts.app')
@section('title', 'Minhas Cobranças | Detalhes')

@section('content')
    <div class="page-title-box">
        <div class="container xl justify-center items-center min-h-[640px]">
            <nav class="p-4">
                <ol class="list-reset flex gap-2">
                    <span class="material-icons text-base ">account_box</span>
                    <li><a href="" class="text-whites hover:text-blue-700">Configurações</a></li>
                    <li><span class="text-white mx-2"> / </span></li>
                    <li class="text-gray-100">Meu Perfil</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 md:grid-cols-12 justify-center items-start gap-5 px-3">
                <div class="md:col-span-4">
                    <div class="pb-5">
                        @livewire('vendor.profile.image')
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="pb-5">
                        @livewire('vendor.profile.form')
                    </div>
                </div>

                <div class="md:col-span-4">
                    <div class="pb-5">
                        @livewire('vendor.profile.password')
                    </div>
                </div>

            </div>
        </div>

@stop
