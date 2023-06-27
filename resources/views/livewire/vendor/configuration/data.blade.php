<div>
    <x-card>
        <form wire:submit.prevent="update">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                Atualizar Dados
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-6 col-span-12">
                    <x-input wire:model="state.name" label="Nome"/>
                    @error('name')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-6 col-span-12">
                    <x-inputs.currency  icon="currency-rupee" thousands="." decimal="," wire:model.defer="state.goals_coins" label="Valor Coins"/>
                    @error('goals_coins')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12">
                    <x-button type="submit" icon="check" spinner="save" positive label="Atualizar" />
                </div>
            </div>
        </form>
    </x-card>
</div>
