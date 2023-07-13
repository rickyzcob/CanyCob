<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="p-4">
            <ol class="list-reset flex gap-2">
                <span class="material-icons text-base ">account_box</span>
                <li><a href="#" class="text-whites hover:text-blue-700">Gestão</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">Usuários</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold p-2">Usuários</h1>
                @can(['tenant_add_user', 'admin_add_user'])
                <x-button icon="home" positive label="Cadastrar" x-data={}
                          x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'vendor.users.form', {'id' : null})">
                </x-button>
                @endcan
            </div>

            @livewire('vendor.users.filter')

            <div class="justify-center items-center mb-2">
                <p> Lista de Usuários Cadastrados </p>
            </div>

            @livewire('vendor.users.table')

        </div>
    </div>
