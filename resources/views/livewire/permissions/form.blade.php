<div>
    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                {{ $role ? 'Atualizar' : 'Cadastrar' }}
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-input icon="user-group" wire:model.defer="state.name" label="Nome da Permissão"  />
                    @error('name')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-12">
                    <x-button type="submit" spinner="save" icon="check" positive label="{{ $role ? 'Atualizar' : 'Cadastrar' }}" />
                </div>
            </div>
        </form>
    </x-card>
</div>
