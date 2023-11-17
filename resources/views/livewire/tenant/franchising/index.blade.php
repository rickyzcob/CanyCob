<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="p-4">
            <ol class="list-reset flex gap-2">
                <span class="material-icons text-base ">post_add</span>
                <li><a href="#" class="text-whites hover:text-blue-700">Cadastro</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">Franqueados</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 mb-4">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold py-2">Franqueados</h1>
                <div>
                    @can('tenant_add_franchising')
                        <x-button icon="plus-circle" positive label="Cadastrar" x-data={}
                                  x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'tenant.franchising.form', {'id' : null})">
                        </x-button>
                    @endcan

                    <x-button icon="upload" info label="Importar"
                              x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'tenant.franchising.import.form', {'id' : null})">
                    </x-button>

                    <x-button warning wire:click="$emit('exportFranchisingForExcel')"  label="Exportar" icon="document" spinner/>
                </div>
            </div>

            @livewire('tenant.franchising.filter')

            <div class="justify-center items-center mb-2">
                <p> Lista de Franqueados Cadastrados</p>
            </div>

            @livewire('tenant.franchising.table')
        </div>
    </div>
