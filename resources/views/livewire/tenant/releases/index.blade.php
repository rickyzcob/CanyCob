<div class="page-title-box">
    <div class="relative container xl justify-center items-center min-h-[640px]">
        <nav class="p-4">
            <ol class="list-reset flex gap-2">
                <span class="material-icons text-base ">post_add</span>
                <li><a href="#" class="text-whites hover:text-blue-700">Cadastro</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">lançamentos</li>
            </ol>
        </nav>
        <div class="card p-5 gap-5 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold py-2">Lançamentos</h1>
                    <div>
                        @can('tenant_add_releases')
                        <x-button icon="plus-circle" positive label="Cadastrar"
                                  x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'tenant.releases.form', {'id' : null})">
                        </x-button>
                        @endcan
                        @can('tenant_import_releases')
                        <x-button icon="upload" info label="Importar"
                                  x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'tenant.releases.import', {'id' : null})">
                        </x-button>
                        @endcan
                        @can('tenant_export_releases')
                        <x-button warning wire:click="$emit('exportExcel')"  label="Exportar" icon="document" spinner/>
                        @endcan
                        @can('tenant_export_releases_historics')
                        <x-button icon="document-report" cyan label="Historico"
                                  x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'tenant.releases.historic', {'id' : null})">
                        </x-button>
                        @endcan
                    </div>
            </div>

            @livewire('tenant.releases.filter')

            <div class="justify-center items-center mb-2">
                <p> Lista de Lançamentos Cadastrados</p>
            </div>

            @livewire('tenant.releases.table')
        </div>
    </div>

