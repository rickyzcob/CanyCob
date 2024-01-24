<div>
    <x-card cardClasses="border-l-4 border-green-500">
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                Escolha a forma de pagamento
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-8 col-span-12">
                    <x-select
                        label="Tipo de Pagamento"
                        wire:model.defer="state.type"
                    >
                        @foreach($response->paymentMethod as $itemPayment)
                            <x-select.option label="{{ $itemPayment['type'] }} - {{ $itemPayment['bank'] }}" value=" {{ $itemPayment['id'] }}" />
                        @endforeach
                    </x-select>
                    @error('type')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-datetime-picker
                        without-time
                        label="Data Vencimento"
                        parse-format="YYYY-MM-DD"
                        wire:model.defer="state.due_date"
                    />
                    @error('due_date')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12">
                    <x-button type="submit" icon="check" spinner="save" positive label="Gerar" />
                </div>
            </div>
        </form>
    </x-card>
</div>
