<div>
    <form wire:submit.prevent="update">
        <div class="flex items-start justify-between border-b-2 mb-5 ">
            Atualizar Dados
        </div>
        <div class="grid grid-cols-12 gap-4">
            <div class="md:col-span-8 col-span-12">
                <x-input wire:model="state.corporate_name" label="Razão Social"/>
                @error('name')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="md:col-span-4 col-span-12">
                <x-input wire:model="state.name" label="Nome Fantasia"/>
                @error('name')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="md:col-span-6 col-span-12">
                <x-inputs.maskable wire:model.defer="state.entities_number" mask="##.###.###/####-##"  emitFormatted="true" label="CNPJ" />
                @error('entities_number')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="md:col-span-6 col-span-12">
                <x-input wire:model="state.state_registration" label="Inscrição Estadual"/>
                @error('state_registration')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-span-12">
                <div class="flex items-start justify-between border-b-2 mb-5 mt-5 ">
                    Endereço
                </div>
            </div>

            <div class="md:col-span-3 col-span-12">
                <x-inputs.maskable wire:model.lazy="state.zip_code" mask="#####-###" label="CEP" />
                @error('zip_code')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-9 col-span-12">
                <x-input wire:model="state.address" label="Endereço"/>
                @error('address')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-2 col-span-12">
                <x-input wire:model="state.number" label="Numero"/>
                @error('number')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-4 col-span-12">
                <x-input wire:model="state.complement" label="Complemento"/>
                @error('complement')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-6 col-span-12">
                <x-input wire:model="state.neighborhood" label="Bairro"/>
                @error('neighborhood')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-6 col-span-12">
                <x-input wire:model="state.city" label="Cidade"/>
                @error('city')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-2 col-span-12">
                <x-input wire:model="state.uf" label="Estado"/>
                @error('uf')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-span-12">
                <div class="flex items-start justify-between border-b-2">
                    Meta dos Colaboradores e Acordos
                </div>
            </div>

            <div class="md:col-span-6 col-span-12">
                <x-inputs.currency  icon="currency-rupee" thousands="." decimal="," wire:model.defer="state.goals_coins" label="Valor Coins"/>
                @error('goals_coins')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-3 col-span-12">
                <x-select
                    label="Tipo de Acordos"
                    placeholder="Automatico"
                    :options="['Normal', 'ClickSign', 'DocuSign']"
                    wire:model.defer="state.type_agreement"
                />
                @error('status')
                <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-span-12">
                <x-button type="submit" icon="check" spinner="save" positive label="Atualizar" />
            </div>
        </div>
    </form>
</div>
