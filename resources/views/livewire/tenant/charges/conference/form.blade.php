<div>
    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                Reprecificar Valores
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-8 col-span-12">
                    <x-input icon="currency-dollar" wire:model.defer="state.payment_code" label="Identificação de Pagamento"/>
                    @error('payment_code')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-12">
                    <x-button type="submit" icon="check" spinner="save" positive label="Salvar" />
                </div>
            </div>
        </form>
    </x-card>
</div>
