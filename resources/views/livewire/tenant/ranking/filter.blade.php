<div>
    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-12 gap-4 py-3 content-end text-gray-600">
            <div class="md:col-span-3 col-span-12">
                <x-input wire:model.defer="state.name" label="Nome" />
            </div>
            <div class="md:col-span-3 col-span-12">
                <x-input wire:model.defer="state.email" label="Email" />
            </div>

            <div class="flex items-end gap-3">
                <x-button type="submit" icon="check" positive label="Buscar" />
                <x-button  gray wire:click.prevent="clearFilter" icon="check" positive label="Limpar" />
            </div>
        </div>
    </form>
</div>
