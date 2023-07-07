<div>
    <x-card>
        <div class="flex items-center justify-between border-b-2 ">
            <h1 class="text-base text-gray-600 font-semibold py-2 pt-2 ">Unidade : {{$response->charge['franchising']['name']}} - <x-badge rounded outline color="{{$response->charge['status']['color']}}" label="{{$response->charge['status']['name']}}" /></h1>
        <div>
                @if($response->charge['agreement'] == 0)
                <x-dropdown>
                    <x-slot name="trigger">
                        <x-button teal sm icon="information-circle" label="Alterar Status" />
                    </x-slot>
                    @foreach($response->status as $itemStatus)
                        <x-dropdown.item wire:click="changeStatus({{ $itemStatus['id'] }})" label="{{ $itemStatus['name'] }}" />
                    @endforeach
                </x-dropdown>
                @endif

                @if($response->charge['agreement'] == 1 && $response->charge['agreementByCharge'] == null && $response->charge['total_amount_corrected'] > auth()->user()->value_agreement )
                <x-button wire:click="openModal('tenant.charges.agreement.form', {'id': {{$response->charge['id']}} })" green sm icon="document-report" label="Gerar Acordo"/>
                @endif

                @if($response->charge['concluded'] == 'Não' && isset($response->charge['agreementByCharge']) && $response->charge['agreementByCharge']['status_id'] == 5 ||
                   $response->charge['concluded'] == 'Não' && $response->charge['payment_code'] != null )
                    <x-button wire:click="changeStatus(15)" green sm icon="check" label="Concluir"/>
                @endif
            </div>
        </div>
    </x-card>
</div>
