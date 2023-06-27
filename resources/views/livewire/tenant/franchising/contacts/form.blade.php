<div>

    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                {{ $contact ? 'Atualizar' : 'Cadastrar' }}
            </div>

            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-6 col-span-12">
                    <x-input icon="user" wire:model.defer="state.name" label="Nome"/>
                    @error('name')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-input icon="mail" wire:model.defer="state.email" label="Email"  />
                    @error('email')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-inputs.maskable
                        mask="['(##) ####-####', '(##) #####-####']"
                        emitFormatted="True"
                        label="Telefone"
                        wire:model.defer="state.phone"  />
                    @error('phone')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
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
                    <x-button type="submit" icon="check" positive label="{{ $contact ? 'Atualizar' : 'Cadastrar' }}" />
                </div>
            </div>
        </form>
    </x-card>
</div>


