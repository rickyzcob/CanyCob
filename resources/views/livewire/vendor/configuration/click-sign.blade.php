<div>
    <form wire:submit.prevent="save">
        <div class="flex items-start justify-between border-b-2 mb-5 ">
            Atualizar Dados
        </div>
        <div class="grid grid-cols-12 gap-4">
            <div class="md:col-span-6 col-span-12">
                <x-input wire:model="state.host" label="Host"/>
                @error('host')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="md:col-span-6 col-span-12">
                <x-input wire:model="state.token" label="Token"/>
                @error('token')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="md:col-span-6 col-span-12">
                <x-input wire:model="state.template_document" label="Token Layout Documento"/>
                @error('template_document')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-span-12">
                <x-button type="submit" icon="check" spinner="save" positive label="{{ $clicksign ? 'Atualizar' : 'Cadastrar' }}" />
            </div>
        </div>
    </form>
</div>

