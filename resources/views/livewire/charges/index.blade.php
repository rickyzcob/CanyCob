<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="p-5">
            <ol class="list-reset flex">
                <li><a href="#" class="text-whites hover:text-blue-700">Franqueados</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">Cobrança</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold py-2">Franqueados</h1>
                <x-button icon="home" positive label="Cadastrar" x-data={}
                          x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'charges.form', {'id' : null})">
                </x-button>

            </div>

            @livewire('charges.filter')

            <div class="justify-center items-center mb-2">
                <p> Lista de Franqueados Em dividas</p>
            </div>

            <div class="flex gap-2">


{{--                <div>--}}
{{--                    @livewire('charges.sidebar')--}}
{{--                </div>--}}

                <div class="w-full">
                    @livewire('charges.table')
                </div>

            </div>

        </div>
    </div>

