<div>
    <x-card>
        <form wire:submit.prevent="update">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                Atualizar Dados
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-input icon="user" wire:model.defer="state.name" label="Nome"/>
                    @error('name')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-12">
                    <x-input icon="mail" type="email" wire:model.defer="state.email" label="Email"  />
                    @error('email')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-6 col-span-12">
                    <x-inputs.maskable icon="phone"
                                       mask="['(##) ####-####', '(##) #####-####']"
                                       emitFormatted="True"
                                       wire:model.defer="state.phone" label="Telefone"
                    />
                    @error('phone')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-6 col-span-12">
                    <x-inputs.maskable
                        mask="['###.###.###-##']"
                        icon="user"
                        wire:model.defer="state.document" label="CPF"/>
                    @error('document')
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


