<div>
    <x-card cardClasses="border-l-4 border-blue-500">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <div class="flex items-center text-base text-blue-500 font-bold gap-x-2">
                <span class="material-icons text-base ">currency_exchange</span>
                <h1 class="text-base  py-1">Valores por tipo de Lançamentos </h1>
            </div>
{{--            @if($charge['agreement'] == 0)--}}
{{--                @can('change_precification_charges')--}}
{{--                    <x-button wire:click="openModal('tenant.charges.precificate.form', {'charge_id': {{$response->charge['id']}} })" info xs icon="information-circle" label="Atualizar Valores"/>--}}
{{--                @endcan--}}
{{--            @endif--}}
        </div>
        <table class="tables_price">
            <thead>
            <tr>
                <th width="450px">Tipo</th>
                <th>Valor</th>
                <th>Correção</th>
                <th width="150px">Ações</th>
             </tr>
            </thead>
            <div style="display: none">
                {{ $total = 0 }}
                {{ $totalnew = 0 }}
            </div>
            <tbody>
            @foreach($response->typeReleases as $itemRelease)
                <tr>
                    <td><x-badge color="{{$itemRelease['typeRelease']['color']}}" label="Total em {{$itemRelease['typeRelease']['name']}}" /></td>
                    <td>{{ formatMoney($itemRelease['value'] )}}</td>
                    <td>{{ formatMoney($itemRelease['value_corrected']) }}</td>
                    <td>
                        <x-button wire:click="openModal('tenant.charges.precificate.form', {'charge_id': {{ $itemRelease['id']}} })" positive xs icon="currency-dollar" label="Gerar Pagamento"/>
                    </td>
                </tr>
                <div style="display: none">{{$total += $itemRelease['value']}}</div>
                <div style="display: none">{{$totalnew +=  $itemRelease['value_corrected']}}</div>
            @endforeach
            </tbody>

            </tbody>
            <tfoot>
            <tr>
                <th class="text-right font-weight-600"></th>
                <th class="text-left font-weight-600">R$ {{number_format($total, 2, ',','.')}}</th>
                <th class="text-left font-weight-600">R$ {{number_format($totalnew, 2, ',','.')}}</th>
                <th class="text-right font-weight-600"></th>
            </tr>
            </tfoot>
        </table>
    </x-card>
</div>
