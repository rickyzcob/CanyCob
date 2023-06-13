<div>
    <x-card cardClasses="border-l-4 border-red-500">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <h1 class="text-base text-gray-600 font-semibold py-2">Unidade : {{$charge['franchising']['name']}}</h1>
            @if($charge['agreement'] == 0)
            <div>
                @can('add_historic_charges')
                <x-button wire:click="openModal('charges.historic.form', {'id': {{$charge['id']}} })" positive sm icon="annotation" label="Cobrar"/>
                @endcan
                @can('whatsapp_proposal_charges')
                <x-button wire:click="openModal('charges.whatsapp.form', {'id': {{$charge['id']}} })" teal sm icon="phone-outgoing" label="Whatsapp"/>
                @endcan
                @can('simulation_charges')
                <x-button wire:click="openModal('charges.simulation.form', {'id': {{$charge['id']}} })" blue sm icon="refresh" label="Simular"/>
                @endcan
            </div>
            @endif
        </div>
        <table class="tables">
            <thead>
            <tr>
                <th width="300px">Nome</th>
                <th>Vencimento</th>
                <th>Valor</th>
                <th>Correção</th>
                <th>Status</th>
            </tr>
            </thead>

            <tbody>
            @foreach($response->releases as $itemRelease)
                <tr>
                    <td>{{ $itemRelease['name'] ? $itemRelease['name'] : 'Sem Informação' }}</td>
                    <td>{{ formatDate($itemRelease['due_date'] ) }}</td>
                    <td>{{ formatMoney($itemRelease['amount'] )}}</td>
                    <td>{{ formatMoney($itemRelease['amount_corrected']) }}</td>
                    <td><x-badge color="{{$itemRelease['status']['color']}}" label="{{$itemRelease['status']['name']}}" /></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-card>
</div>
