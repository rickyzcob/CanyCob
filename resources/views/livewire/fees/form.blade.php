<div>

    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                {{ $fees ? 'Atualizar' : 'Cadastrar' }}
            </div>

            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-6 col-span-12">
                    <x-input icon="user" wire:model.defer="state.name" label="Nome"/>
                    @error('name')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-inputs.maskable
                        label="Porcentagem"
                        emitFormatted="True"
                        mask="['#,##', '##,##', '###,##']"
                        wire:model.defer="state.value"
                    />
                    @error('value')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-select
                        label="Tipo"
                        placeholder="Tipo"

                        :options="['Year', 'Month']"
                        wire:model.defer="state.type"
                    />
                    @error('status')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
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

                <div class="md:col-span-4 col-span-12">
                    <x-select
                        label="Automatico"
                        placeholder="Automatico"
                        :options="['Sim', 'Não']"
                        wire:model.defer="state.automatic"
                    />
                    @error('status')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>



                <div class="col-span-12">
                    <x-button type="submit" icon="check" spinner="save" positive label="{{ $fees ? 'Atualizar' : 'Cadastrar' }}" />
                </div>
            </div>
        </form>
    </x-card>
</div>


