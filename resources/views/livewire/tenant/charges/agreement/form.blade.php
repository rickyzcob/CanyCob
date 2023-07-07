<div>
    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
              Cadastrar Acordo
            </div>
{{--            <div class="mb-4 rounded-lg bg-warning-100 px-6 py-5 text-base text-warning-800" role="alert">--}}
{{--                Formulário já preenchido com os dados do acordo aceito pelo sócio.--}}
{{--            </div>--}}
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <div class="styled-1">
                        <x-native-select wire:model="state.partner_id" label="Escolha a quem fazer a Cobrança" >
                            <option value="">Escolha</option>
                            @foreach($response->partners as $itemPartner)
                                <option value="{{ $itemPartner['partner']['id'] }}"> {{$itemPartner['partner']['name']}}  </option>
                            @endforeach

                        </x-native-select>
                    </div>
                    @error('partner_id')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-3 col-span-12">
                    <x-inputs.currency  prefix="R$ " thousands="." decimal="," wire:model.defer="state.amount_corrected" label="Valor Corrigido"/>
                    @error('amount_corrected')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-5 col-span-12">
                    <x-select
                        label="Tipo"
                        :options="['A Vista', 'Parcelado sem Entrada', 'Parcelado com Entrada']"
                        wire:model="state.type"
                    />
                    @error('type')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                @if($state['type'] == 'Parcelado com Entrada')

                    <div class="md:col-span-3 col-span-12">
                        <x-inputs.currency prefix="R$ " thousands="." decimal="," wire:model.defer="state.inflow" label="Entrada" />
                        @error('inflow')
                        <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md:col-span-3 col-span-12">
                        <x-inputs.number wire:model.defer="state.installments" label="Parcelas" />
                        @error('installments')
                        <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md:col-span-3 col-span-12">
                        <x-inputs.currency prefix="R$ " thousands="." decimal=","  wire:model.defer="state.installment_value" label="Valor Parcela" />
                        @error('installment_value')
                        <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                        @enderror
                    </div>
                @elseif($state['type'] == 'Parcelado sem Entrada')
                    <div class="md:col-span-3 col-span-12">
                        <x-inputs.number wire:model.defer="state.installments" label="Parcelas" />
                        @error('installments')
                        <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md:col-span-3 col-span-12">
                        <x-inputs.currency prefix="R$ " thousands="." decimal=","  wire:model.defer="state.installment_value" label="Valor Parcela" />
                        @error('installment_value')
                        <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

{{--                <div class="md:col-span-3 col-span-12">--}}
{{--                    <x-inputs.currency prefix="R$ " thousands="." decimal="," wire:model.defer="state.inflow" label="Entrada" />--}}
{{--                    @error('inflow')--}}
{{--                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="md:col-span-3 col-span-12">--}}
{{--                    <x-inputs.number wire:model.defer="state.installments" label="Parcelas" />--}}
{{--                    @error('installments')--}}
{{--                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="md:col-span-3 col-span-12">--}}
{{--                    <x-inputs.currency prefix="R$ " thousands="." decimal=","  wire:model.defer="state.installment_value" label="Valor Parcela" />--}}
{{--                    @error('installment_value')--}}
{{--                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                <div class="md:col-span-3 col-span-12">
                    <x-datetime-picker
                        label="Data Vencimento"
                        without-time="true"
                        parse-format="YYYY-MM-DD"
                        wire:model.defer="state.due_date"
                    />
                    @error('due_date')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-12">
                    <x-button type="submit" icon="check" spinner="save" positive label="Cadastrar" />
                    <x-button wire:click="getDataProposal()" icon="refresh" gray label="Usar Dados Proposta" />
                </div>
            </div>
        </form>
    </x-card>
</div>
