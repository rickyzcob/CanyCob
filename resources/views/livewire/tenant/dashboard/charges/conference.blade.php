<div>
    <div class="scrollbar-charges" id="style-1">
        <div style="overflow-x:auto;">
            <table class="tables">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Valor Devido</th>
                    <th>Correção</th>
                    <th>Status</th>
                    <div class="justify-items-center">
                        <th>Açoes</th>
                    </div>
                </tr>
                </thead>

                <tbody>
                @foreach($response->charges as $itemCharge)
                    <tr>
                        <td>{{ $itemCharge['franchising']['name'] }}</td>
                        <td>{{ $itemCharge['franchising']['cnpj'] }}</td>
                        <td> {{ formatMoney($itemCharge['total_amount']) }}</td>
                        <td> {{ formatMoney($itemCharge['total_amount_corrected']) }}</td>
                        <td> <x-badge outline color="{{$itemCharge['status']['color']}}" label="{{$itemCharge['status']['name']}}" /></td>
                        <td width="200px">
{{--                            @if($itemCharge['agreement'] == 0)--}}
{{--                                <div class="flex gap-2">--}}
{{--                                    @can('add_historic_charges')--}}
{{--                                        <x-button wire:click="openModal('tenant.charges.historic.form', {'id': {{$itemCharge['id']}} })" positive sm icon="annotation" label="Cobrar"/>--}}
{{--                                    @endcan--}}
{{--                                    @can('whatsapp_proposal_charges')--}}
{{--                                        <x-button class="fa fa-whatsapp" wire:click="openModal('tenant.charges.whatsapp.form', {'id': {{$itemCharge['id']}} })" teal sm label="Whatsapp"/>--}}
{{--                                    @endcan--}}
{{--                                    @can('simulation_charges')--}}
{{--                                        @if($itemCharge['total_amount_corrected'] > $response->configuration['value_agreement'])--}}
{{--                                            <x-button wire:click="openModal('tenant.charges.simulation.form', {'id': {{$itemCharge['id']}} })" blue sm icon="refresh" label="Simular"/>--}}
{{--                                        @endif--}}
{{--                                    @endcan--}}
{{--                                </div>--}}
{{--                            @endif--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


