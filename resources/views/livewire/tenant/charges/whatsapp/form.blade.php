<x-card>
    <div class="flex items-start justify-between border-b-2 mb-2 py-2">
        <h1 class="text-lg text-gray-600 font-semibold">Enviar Whatsapp </h1>
    </div>
    <form wire:submit.prevent="send">
        <div class="grid grid-cols-12 gap-4 py-3 content-end text-gray-600">
            <div class="col-span-12">
                <x-select
                    label="Escolha a quem enviar a Cobrança"
                    wire:model.defer="state.partner_id"
                >
                    @foreach($response->partners as $itemPartner)
                        <x-select.option label="{{$itemPartner['partner']['id']}}  - {{$itemPartner['partner']['name']}} - {{$itemPartner['partner']['phone']}} " value="{{$itemPartner['partner']['id']}}" />
                    @endforeach
                </x-select>
                @error('partner_id')
                <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex items-end gap-3">
                <x-button type="submit" spinner="send" icon="check" positive label="Enviar" />
            </div>
        </div>
    </form>
</x-card>
