<div>
    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                Cadastrar nova Proposta
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-6">
                    <x-select
                        label="Template"
                        wire:model.defer="state.template_proposal_id"                    >
                        @foreach($response->templatePrososals as $itemTemplate)
                            <x-select.user-option src="https://via.placeholder.com/500" label="{{$itemTemplate['name']}}" value="{{$itemTemplate['id']}}" />
                        @endforeach
                    </x-select>
                    @error('template_proposal_id')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-6">
                    <x-select
                        label="Destinatário"
                        wire:model.defer="state.partner_id">
                        @foreach($response->partners as $itemPartner)
                            <x-select.option label="{{$itemPartner['partner']['name']}}" value="{{$itemPartner['partner']['id']}}" />
                        @endforeach
                    </x-select>
                    @error('partner_id')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-4 col-span-12">
                    <x-inputs.currency  prefix="R$ " thousands="." decimal="," wire:model.defer="state.amount_corrected" label="Valor Corrigido"/>
                    @error('amount_corrected')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-4 col-span-12">
                    <x-inputs.number wire:model.defer="state.installments" label="Parcelas" />
                    @error('installments')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-inputs.number wire:model.defer="state.days" label="Validade" />
                    @error('days')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12">
                    <x-button type="submit" icon="check" positive label="Cadastrar" />
                </div>
            </div>
        </form>
    </x-card>
</div>
