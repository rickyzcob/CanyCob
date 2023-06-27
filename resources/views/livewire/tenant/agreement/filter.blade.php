<div>
    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-12 gap-4 py-3 items-start text-gray-600">
            <div class="md:col-span-4 col-span-12">
                <x-input wire:model.defer="state.name" label="Nome" />
            </div>

            <div class="md:col-span-2 col-span-12">
                <x-inputs.maskable wire:model.defer="state.cnpj" mask="##.###.###/####-##"  emitFormatted="true" label="CNPJ" />
            </div>

            <div class="md:col-span-3 col-span-12">
                <x-select
                    label="Escolha o status"
                    multiselect
                    wire:model.defer="state.status_id"
                >
                    @foreach($response->statusAgreements as $itemStatus)
                        <x-select.option label="{{$itemStatus['name']}}" value="{{$itemStatus['id']}}" />
                    @endforeach
                </x-select>
            </div>


            <div class="flex items-start gap-3 pt-6">
                <x-button type="submit" icon="search" positive label="Buscar" />
                <x-button gray wire:click.prevent="clearFilter" icon="check" positive label="Limpar" />
            </div>
        </div>
    </form>
</div>

