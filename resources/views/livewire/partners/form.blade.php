<div>

    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
            {{ $partner ? 'Atualizar' : 'Cadastrar' }}
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
                        wire:model.defer="state.phone"
                        mask="['(##) ####-####', '(##) #####-####']"
                        emitFormatted="True"
                        label="Telefone"  />
                    @error('phone')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-inputs.maskable
                        mask="['###.###.###-##']"
                        wire:model.defer="state.cpf" label="CPF" />
                    @error('cpf')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12">
                    <x-button type="submit" spinner="save" icon="check" positive label="{{ $partner ? 'Atualizar' : 'Cadastrar' }}" />
                </div>
            </div>
        </form>
    </x-card>
</div>

