<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="p-4">
            <ol class="list-reset flex gap-2">
                <span class="material-icons text-base ">star_half</span>
                <li><a href="#" class="text-whites hover:text-blue-700">Gestão</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">Ranking</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold py-2">Ranking Mensal</h1>
                <x-button icon="user-add" positive label="Zerar Pontuação" wire:click="resetCoinsByMonth()">
                </x-button>

                {{--                <x-button positive icon="user-add" label="Cadastrar" wire:click.prevent="openModal('partners.form', {'id': null } )"  />--}}
            </div>

            @livewire('tenant.ranking.filter')

            <div class="justify-center items-center mb-2">
                <p> Ranking de pontuação de todos os usarios do mês de  </p>
            </div>

            @livewire('tenant.ranking.table')
        </div>
    </div>
