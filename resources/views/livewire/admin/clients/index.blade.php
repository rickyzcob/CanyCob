<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="py-5">
            <ol class="list-reset flex">
                <li><a href="#" class="text-whites hover:text-blue-700">Admin</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">Clientes</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold p-2">Clientes</h1>
{{--                @can('add_user')--}}
                    <x-button icon="home" positive label="Cadastrar" x-data={}
                              x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'admin.clients.form', {'id' : null})">
                    </x-button>
{{--                @endcan--}}
            </div>

            @livewire('admin.clients.filter')

            <div class="justify-center items-center mb-2">
                <p> Lista de Clientes Cadastrados </p>
            </div>

            @livewire('admin.clients.table')

        </div>
    </div>
