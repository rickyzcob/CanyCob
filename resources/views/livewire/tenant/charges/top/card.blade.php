<div>
    <x-card cardClasses="border-l-4 border-orange-400">
        <div class="grid md:grid-cols-12 gap-2 text-orange-600 ">
            <div class="md:col-span-4 border-r-2 border-gray-200 pr-2">
                <div class="flex items-center justify-between pb-2">
                    <h1 class="text-base font-bold py-1">Dados do franqueado</h1>
                    @if($charge['agreement'] == 0)
                        @can('tenant_edit_franchising_charges')
                            <x-button.circle wire:click="openModal('tenant.franchising.form', {'id': {{$response->charge['franchising']['id']}} })" xs warning icon="pencil-alt" />
                        @endcan
                    @endif
                </div>
                <div>
                    <p> <span class="font-bold"> Franqueado : </span>{{$response->charge['franchising']['name']}}</p>
                    <p> <span class="font-bold"> Endereço : </span> {{$response->charge['franchising']['address']}} - {{$response->charge['number']}} - {{$response->charge['franchising']['complement']}} - {{$response->charge['franchising']['zip_code']}} - {{$response->charge['franchising']['city']}} - {{$response->charge['franchising']['state']}}  </p>
{{--                    <p> <span class="font-bold"> Telefones : </span> {{$response->charge['franchising']['phone01']}} - {{$response->charge['phone02']}}</p>--}}
                    <p> <span class="font-bold"> CNPJ : </span> {{$response->charge['franchising']['employer_number']}} <span class="font-bold"> Inscrição Estadual : </span> {{$response->charge['franchising']['state_registration']}} </p>
                </div>
            </div>

            <div class="md:col-span-4 border-r-2 border-gray-200 pr-2">
                <div class="flex items-center justify-between pb-2">
                    <h1 class="text-base font-bold py-1">Valores</h1>
                    @if($charge['agreement'] == 0)
                        @can('tenant_change_precification_charges')
                            <x-button wire:click="openModal('tenant.charges.precificate.form', {'charge_id': {{$response->charge['id']}} })" warning xs icon="information-circle" label="Atualizar Valores"/>
                        @endcan
                    @endif
                </div>
                <div class="flex items-start justify-between mb-2">
                    <div class="justify-between items-center w-1/2">
                        <p> <span class="font-bold"> Valor Original : </span>{{formatMoney($response->charge['total_amount'])}}</p>
                        <p> <span class="font-bold"> Valor Corrigido : </span> {{formatMoney($response->charge['total_amount_corrected'])}} </p>
                        <p> <span class="font-bold"> Total de Cobranças : </span> {{ $response->charge['totalHistorics']->count('id')}} </p>
                     </div>
                    <div>
                        <p> <span class="font-bold"> Ultima Atualização : </span> {{formatDate($response->charge['updated_at'])}} </p>
                        <p> <span class="font-bold"> Total de Lançamentos : </span> {{ $response->charge['releases']->count('id') }} </p>
                        <p class="pb-3"> <span class="font-bold"> Propostas Emitidas: </span> {{ $response->charge['proposals']->count('id') }} </p>
                    </div>
                </div>

            </div>
            <div class="md:col-span-4 border-gray-200 pr-2">
                <div class="flex items-center justify-between pb-2">
                    <h1 class="text-base font-bold py-1">Estatus da Cobrança</h1>
                                    @if($response->charge['agreement'] == 0)
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <x-button teal xs icon="information-circle" label="Alterar Status" />
                                        </x-slot>
                                        @foreach($response->status as $itemStatus)
                                            <x-dropdown.item wire:click="changeStatus({{ $itemStatus['id'] }})" label="{{ $itemStatus['name'] }}" />
                                        @endforeach
                                    </x-dropdown>
                                    @endif

                                    @if($response->charge['agreement'] == 1 && $response->charge['agreementByCharge'] == null && $response->charge['total_amount_corrected'] > auth()->user()->value_agreement )
                                    <x-button wire:click="openModal('tenant.charges.agreement.form', {'id': {{$response->charge['id']}} })" green xs icon="document-report" label="Gerar Acordo"/>
                                    @endif

                                    @if($response->charge['concluded'] == 'Não' && isset($response->charge['agreementByCharge']) && $response->charge['agreementByCharge']['status_id'] == 5 ||
                                       $response->charge['concluded'] == 'Não' && $response->charge['payment_code'] != null )
                                        <x-button wire:click="changeStatus(15)" green xs icon="check" label="Concluir"/>
                                    @endif
                </div>
                <div class="flex items-start justify-between mb-2">
                    <div class="justify-between items-center w-1/2">
                        <p> <span class="font-bold"> Status Atual: </span> <x-badge rounded outline color="{{$response->charge['status']['color']}}" label="{{$response->charge['status']['name']}}" /> </p>
                        <div class="flex items-start justify-between mb-2">
                            @if($response->lastHistoric)
                                <p> <span class="font-bold"> Última Cobrança : </span> {{formatDateAndTime($response->charge['historics'][0]['created_at'])}} via
                                    <span class="font-bold"> {{$response->charge['historics'][0]['type']}}  </span> </p>
                            @else
                                <p> <span class="font-bold"> Sem Histórico  </span> </p>
                            @endif
                        </div>
                    </div>
                    <div>
{{--                        <p> <span class="font-bold"> Ultima Atualização : </span> {{formatDate($response->charge['updated_at'])}} </p>--}}
{{--                        <p> <span class="font-bold"> Total de Lançamentos : </span> {{ $response->charge['releases']->count('id') }} </p>--}}
{{--                        <p class="pb-3"> <span class="font-bold"> Propostas Emitidas: </span> {{ $response->charge['proposals']->count('id') }} </p>--}}
                    </div>
                </div>
            </div>
                {{--            <div class="md:col-span-4 border-r-2 border-gray-200 pr-2">--}}
{{--                        <div class="flex items-start justify-between mb-2">--}}
{{--                            <div class="justify-between items-center w-1/2">--}}
{{--                                <p> <span class="font-bold"> Valor Original : </span>{{formatMoney($response->charge['total_amount'])}}</p>--}}
{{--                                <p> <span class="font-bold"> Valor Corrigido : </span> {{formatMoney($response->charge['total_amount_corrected'])}} </p>--}}
{{--                                <p> <span class="font-bold"> Total de Cobranças : </span> {{ $response->charge['totalHistorics']->count('id')}} </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                            <div>--}}
{{--                                <p> <span class="font-bold"> Ultima Atualização : </span> {{formatDate($response->charge['updated_at'])}} </p>--}}
{{--                                <p> <span class="font-bold"> Total de Lançamentos : </span> {{ $response->charge['releases']->count('id') }} </p>--}}
{{--                                <p class="pb-3"> <span class="font-bold"> Propostas Emitidas: </span> {{ $response->charge['proposals']->count('id') }} </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="flex items-start justify-between mb-2">--}}
{{--                            @if($response->lastHistoric)--}}
{{--                                <p> <span class="font-bold"> Última Cobrança : </span> {{formatDateAndTime($response->charge['historics'][0]['created_at'])}} via--}}
{{--                                    <span class="font-bold"> {{$response->charge['historics'][0]['type']}}  </span> </p>--}}
{{--                            @else--}}
{{--                                <p> <span class="font-bold"> Sem Histórico : </span> </p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--            </div>--}}


{{--        <div class="flex items-center justify-between border-b-2 ">--}}
{{--            <h1 class="text-base text-gray-600 font-semibold py-2 pt-2 ">Unidade : {{$response->charge['franchising']['name']}} - </h1>--}}
{{--                <div>--}}
{{--                @if($response->charge['agreement'] == 0)--}}
{{--                <x-dropdown>--}}
{{--                    <x-slot name="trigger">--}}
{{--                        <x-button teal xs icon="information-circle" label="Alterar Status" />--}}
{{--                    </x-slot>--}}
{{--                    @foreach($response->status as $itemStatus)--}}
{{--                        <x-dropdown.item wire:click="changeStatus({{ $itemStatus['id'] }})" label="{{ $itemStatus['name'] }}" />--}}
{{--                    @endforeach--}}
{{--                </x-dropdown>--}}
{{--                @endif--}}

{{--                @if($response->charge['agreement'] == 1 && $response->charge['agreementByCharge'] == null && $response->charge['total_amount_corrected'] > auth()->user()->value_agreement )--}}
{{--                <x-button wire:click="openModal('tenant.charges.agreement.form', {'id': {{$response->charge['id']}} })" green xs icon="document-report" label="Gerar Acordo"/>--}}
{{--                @endif--}}

{{--                @if($response->charge['concluded'] == 'Não' && isset($response->charge['agreementByCharge']) && $response->charge['agreementByCharge']['status_id'] == 5 ||--}}
{{--                   $response->charge['concluded'] == 'Não' && $response->charge['payment_code'] != null )--}}
{{--                    <x-button wire:click="changeStatus(15)" green xs icon="check" label="Concluir"/>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
        </div>
    </x-card>
</div>
