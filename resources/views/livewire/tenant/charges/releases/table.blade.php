<div style="overflow-x:auto;">
    <x-card cardClasses="border-l-4 border-red-500">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <h1 class="text-base text-gray-600 font-semibold py-2">Unidade : {{$charge['franchising']['name']}}</h1>

            <div class="flex gap-2">
                @if($charge['agreement'] == 0)
                @can('add_historic_charges')
                <x-button wire:click="openModal('tenant.charges.historic.form', {'id': {{$charge['id']}} })" positive sm icon="annotation" label="Cobrar"/>
                @endcan
                @can('whatsapp_proposal_charges')
                <x-button class="fa fa-whatsapp" wire:click="openModal('tenant.charges.whatsapp.form', {'id': {{$charge['id']}} })" teal sm label="Whatsapp"/>
                @endcan
                @can('simulation_charges')
                    @if($charge->total_amount_corrected > auth()->user()->value_agreement)
                        <x-button wire:click="openModal('tenant.charges.simulation.form', {'id': {{$charge['id']}} })" blue sm icon="refresh" label="Simular"/>
                    @endif
                @endcan
                @endif
                    @if($charge->total_amount_corrected < auth()->user()->value_agreement && $charge->status_id = 17 && $charge->agreement == 1 && $charge->concluded == 'Não')
                <x-button icon="check-circle"  wire:click="openModal('tenant.charges.conference.form', {'id': {{$charge['id']}} })" warning sm label="Conferir"/>
                    @endif

            </div>
        </div>
        <table class="tables">
            <thead>
            <tr>
                <th width="250px">Nome</th>
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
        <div class="flex justify-between text-black gap-2 py-5 text-gray-600 text-sm">
            <div class="flex items-center gap-2">
                Mostrando  <x-native-select
                    :options="['10', '15', '20', '30']"
                    wire:model="pageSize"
                />
                de {{ $response->releases->total() }}
                itens
            </div>
            <div>
                {{ $response->releases->links() }}
            </div>
        </div>
    </x-card>
</div>
