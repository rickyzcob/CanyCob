<div>
    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                Reprecificar Valores
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-6">
                    <x-select
                        label="Taxa Multa de Atraso"
                        wire:model.defer="state.fees_year"
                    >
                        @foreach($response->anualfees as $itemAnualFees)
                            <x-select.option label="{{$itemAnualFees['name']}}" value="{{$itemAnualFees['id']}}" />
                        @endforeach
                    </x-select>
                    @error('fees_year')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-6">
                    <x-select
                        label="Taxa Juros Mês"
                        wire:model.defer="state.fees_month"
                    >
                        @foreach($response->monthfees as $itemMonthFees)
                            <x-select.option label="{{$itemMonthFees['name']}}" value="{{$itemMonthFees['id']}}" />
                        @endforeach
                    </x-select>
                    @error('fees_month')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12">
                    <x-button type="submit" icon="check" positive label="Atualizar" />
                </div>
            </div>
        </form>
    </x-card>
</div>
