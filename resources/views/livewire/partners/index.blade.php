<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="py-5">
            <ol class="list-reset flex">
                <li><a href="#" class="text-whites hover:text-blue-700">Franqueados</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">Sócios</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold p-2">Sócios</h1>
                <x-button icon="user-add" positive label="Cadastrar" x-data={}
                          x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'partners.form', {'id' : null})">
                </x-button>

{{--                <x-button positive icon="user-add" label="Cadastrar" wire:click.prevent="openModal('partners.form', {'id': null } )"  />--}}
            </div>

            @livewire('partners.filter')

            <div class="justify-center items-center mb-2">
                <p> Lista de Marcas Cadastradas </p>
            </div>

            @livewire('partners.table')
        </div>
    </div>
