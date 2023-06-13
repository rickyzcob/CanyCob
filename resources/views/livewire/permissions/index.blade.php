<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="py-5">
            <ol class="list-reset flex">
                <li><a href="#" class="text-whites hover:text-blue-700">Cadastro</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">Permissões</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold py-2">Permissões</h1>
                @can('add_permission')
                <x-button icon="user-add" positive label="Cadastrar" x-data={}
                          x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'permissions.form', {'id' : null})">
                </x-button>
                @endcan
            </div>

            @livewire('permissions.filter')

            <div class="justify-center items-center mb-2">
                <p> Lista de permissões cadastradas </p>
            </div>

            @livewire('permissions.table')
        </div>
    </div>
