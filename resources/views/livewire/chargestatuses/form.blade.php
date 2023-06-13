<div>

    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                {{ $chargeStatus ? 'Atualizar' : 'Cadastrar' }}
            </div>

            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-6 col-span-12">
                    <x-input icon="user" wire:model.defer="state.name" label="Nome"/>
                    @error('name')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-color-picker  wire:model.defer="state.color"  label="Cor de Fundo"
                     :colors="[
                        [ 'name' => 'White',  'value' => 'white' ],
                        [ 'name' => 'Black',  'value' => 'black' ],
                        [ 'name' => 'Laranja',   'value' => 'orange' ],
                        [ 'name' => 'Verde',  'value' => 'green' ],
                        [ 'name' => 'Vermelho',    'value' => 'red' ],
                        [ 'name' => 'Azul',   'value' => 'blue' ],
                        [ 'name' => 'Cinza',    'value' => 'gray' ],
                        [ 'name' => 'Violet', 'value' => 'violet' ],
                        [ 'name' => 'Pink',   'value' => 'pink' ],
                        [ 'name' => 'Indigo', 'value' => 'indigo' ],
                    ]"/>

                    @error('color')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-select
                        label="Status"
                        placeholder="Status"

                        :options="['Ativo', 'Inativo']"
                        wire:model.defer="state.status"
                    />
                    @error('status')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12">
                    <x-button type="submit" icon="check" spinner="save" positive label="{{ $chargeStatus ? 'Atualizar' : 'Cadastrar' }}" />
                </div>
            </div>
        </form>
    </x-card>
</div>


