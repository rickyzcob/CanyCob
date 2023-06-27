<div>
    <x-card>
        <div class="flex items-start justify-between border-b-2 mb-2">
            <h1 class="text-lg text-gray-600 font-semibold p-2">Relação de Lançamentos da Importação</h1>
            {{--            <x-button wire:click="openModal('tenant.charges.historic.form', {'id': {{$franchising['id']}} }, 2)" positive sm icon="plus-circle" label="Cobrar"/>--}}
        </div>
        <table class="tables">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Unidade</th>
                    <th>Venc</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($response->releasesHistorics as $itemHistoric)
                <tr>
                    <td>{{ $itemHistoric['name'] }}</td>
                    <td>{{ $itemHistoric['franchising']['name'] }}</td>
                    <td>{{ $itemHistoric['cnpj'] }}</td>
                    <td>{{ formatDate($itemHistoric['due_date'] )}}</td>
                    <td>{{ formatMoney($itemHistoric['amount'] )}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-card>
</div>
