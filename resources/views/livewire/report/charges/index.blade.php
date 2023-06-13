<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="py-5">
            <ol class="list-reset flex">
                <li><a href="#" class="text-whites hover:text-blue-700">Lançamentos</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">Importar Lançamento</li>
            </ol>
        </nav>
        <div class="card p-5 gap-5 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold py-2">Lançamentos</h1>
                <div>
{{--                    <x-button icon="plus-circle" positive label="Cadastrar"--}}
{{--                              x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'releases.form', {'id' : null})">--}}
{{--                    </x-button>--}}

{{--                    <x-button icon="upload" info label="Importar"--}}
{{--                              x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'releases.import', {'id' : null})">--}}
{{--                    </x-button>--}}

                    <x-button warning wire:click="$emit('exportExcel')"  label="Exportar" icon="document" spinner/>

{{--                    <x-button icon="document-report" cyan label="Historico"--}}
{{--                              x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'releases.historic', {'id' : null})">--}}
{{--                    </x-button>--}}

                    {{--                        @if($exportFinished)--}}
                    {{--                            <x-button rose wire:click="downloadExcel"  label="Download" icon="cloud-download" />--}}
                    {{--                        @endif--}}
                </div>
            </div>

            @livewire('releases.filter')

            <div class="justify-center items-center mb-2">
                <p> Lista de Lançamentos Cadastrados</p>
            </div>

            @livewire('releases.table')
        </div>
    </div>


