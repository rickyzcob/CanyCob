<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Em Dia ?</th>
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
                <td>@if ($itemCharge['releases']->count() > 0 )  Não @else Sim @endif</td>
                <td>{{ $itemCharge['franchising']['cnpj'] }}</td>
                <td> {{ formatMoney($itemCharge['total_amount']) }}</td>
                <td> {{ formatMoney($itemCharge['total_amount_corrected']) }}</td>
                <td> {{ $itemCharge['status']['name'] }}</td>
                <td width="200px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
{{--                        <x-button a href="{{route('charges.show', $itemCharge['id'])}} "sm gray icon="eye" primary />--}}
                        <x-button a href="{{route('charges.show', $itemCharge['reference'])}}" sm gray icon="eye" primary />
                        <x-button sm teal icon="cash" primary wire:click="openModal('charges.releases.table', {'id': {{ $itemCharge['id'] }} } )"/>
                        <x-button sm orange icon="folder-open" primary wire:click="openModal('franchising.contacts.table', {'id': {{ $itemCharge['franchising_id'] }} } )"/>
                        <x-button sm cyan icon="folder" primary wire:click="openModal('franchising.folder.card', {'id': {{ $itemCharge['franchising_id'] }} } )"/>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="flex justify-between text-black gap-2 py-5 text-gray-600 text-sm">
        <div class="flex items-center gap-2">
            Mostrando  <x-native-select
                :options="['10', '15', '20', '30', '60']"
                wire:model="pageSize"
            />
            de {{ $response->charges->total() }}
            itens
        </div>
        <div>
            {{ $response->charges    ->links() }}
        </div>
    </div>
</div>

