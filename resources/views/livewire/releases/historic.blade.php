<div>
    <x-card>
        <div class="flex items-start justify-between border-b-2 mb-2">
            <h1 class="text-lg text-gray-600 font-semibold p-2">Históricos de Importações de Dados</h1>
{{--            <x-button wire:click="openModal('charges.historic.form', {'id': {{$franchising['id']}} }, 2)" positive sm icon="plus-circle" label="Cobrar"/>--}}
        </div>
        <table class="tables">
            <thead>
            <tr>
                <th>Tipo</th>
                <th>Usuário</th>
                <th>Data</th>
                <th>Qtd</th>
                <th>Ações</th>
            </tr>
            </thead>

            <tbody>
            @foreach($response->historics as $itemHistoric)
                <tr>
                    <td>{{ $itemHistoric['type'] }}</td>
                    <td>{{ $itemHistoric['user']['name'] }}</td>
                    <td>{{ formatDateAndTime($itemHistoric['date'] )}}</td>
                    <td>{{ $itemHistoric['quantity'] }}</td>
                    <td><x-button sm teal icon="eye" primary wire:click="openModal('releases.releases', {'id': {{ $itemHistoric['id'] }} }, 2)"/></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-card>
</div>
