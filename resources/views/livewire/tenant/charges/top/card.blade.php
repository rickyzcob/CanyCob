<div>
    <x-card>
{{--        @dd($response->charge['status']['name'])--}}
        <div class="flex items-center justify-between border-b-2 ">
            <h1 class="text-base text-gray-600 font-semibold py-2 pt-2 ">Unidade : {{$response->charge['franchising']['name']}} - <x-badge rounded outline color="{{$response->charge['status']['color']}}" label="{{$response->charge['status']['name']}}" /></h1>

{{--            <x-button wire:click="openModal('tenant.charges.proposal.form', {'id': {{$charge['id']}} })" teal sm icon="information-circle" label="Alterar Status"/>--}}
            <div>
                @if($response->charge['agreement'] == 0)
                <x-dropdown>
                    <x-slot name="trigger">
                        <x-button teal sm icon="information-circle" label="Alterar Status" />
                    </x-slot>
                    @if($response->charge['total_amount_corrected'] > $configuration ['value_agreement'])
                    @foreach($response->status as $itemStatus)
                        <x-dropdown.item wire:click="changeStatus({{ $itemStatus['id'] }})" label="{{ $itemStatus['name'] }}" />
                    @endforeach
                    @else
                        @foreach($response->statusComum as $itemStatus)
                            <x-dropdown.item wire:click="changeStatus({{ $itemStatus['id'] }})" label="{{ $itemStatus['name'] }}" />
                        @endforeach
                    @endif
                </x-dropdown>
                @endif

                @if($response->charge['agreement'] == 1 && $response->charge['agreementByCharge'] == null)
                <x-button wire:click="openModal('tenant.charges.agreement.form', {'id': {{$response->charge['id']}} })" green sm icon="document-report" label="Gerar Acordo"/>
                @endif

                @if(isset($response->charge['agreementByCharge']) && $response->charge['agreementByCharge']['status_id'] == 5)
                    <x-button wire:click="changeStatus(16)" green sm icon="document-report" label="Concluir"/>
                @endif
            </div>
        </div>
    {{--        <div class="flex items-start justify-between mb-2">--}}
    {{--            <div class="justify-between items-center w-full">--}}
    {{--                <p> <span class="font-bold"> Razão Social : </span>{{$franchising['razao_social']}}</p>--}}
    {{--                <p> <span class="font-bold"> Endereço : </span> {{$franchising['address']}} - {{$franchising['number']}} - {{$franchising['complement']}} - {{$franchising['cep']}} </p>--}}
    {{--                <p> <span class="font-bold"> Região : </span> {{$franchising['regiao']}} </p>--}}
    {{--                <p> <span class="font-bold"> Telefones : </span> {{$franchising['phone01']}} - {{$franchising['phone02']}}</p>--}}
    {{--                <p> <span class="font-bold"> CNPJ : </span> {{$franchising['cnpj']}} <span class="font-bold"> Inscrição Estadual : </span> {{$franchising['insc']}} </p>--}}
    {{--                <p> <span class="font-bold"> {{$franchising['city']}} - {{$franchising['state']}}  </span>  </p>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    </x-card>
</div>
