<div>
    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-12 gap-4 py-3 content-end text-gray-600">
            <div class="md:col-span-4 col-span-12">
                <x-input wire:model.defer="state.name" label="Nome" />
            </div>
            <div class="md:col-span-2 col-span-12">
                <x-select
                    label="Status"
                    placeholder="Status"
                    :options="['Ativo', 'Inativo']"
                    wire:model.defer="state.status"
                />
            </div>
            <div class="md:col-span-2 col-span-12">
                <x-select
                    label="Automatico"
                    placeholder="Status"
                    :options="['Sim', 'Não']"
                    wire:model.defer="state.status"
                />
            </div>
            <div class="flex items-end gap-3">
                <x-button type="submit" icon="search" positive label="Buscar" />
                <x-button gray wire:click.prevent="clearFilter" icon="check" positive label="Limpar" />
            </div>
        </div>
    </form>
</div>
