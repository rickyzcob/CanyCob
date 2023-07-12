<div>
    <x-card>
        <div class="flex items-start justify-between border-b-2 mb-2">
            <h1 class="text-lg text-gray-600 font-semibold p-2">Históricos de Importações de Dados</h1>
            {{--            <x-button wire:click="openModal('tenant.charges.historic.form', {'id': {{$franchising['id']}} }, 2)" positive sm icon="plus-circle" label="Cobrar"/>--}}
        </div>
        <table class="tables">
            <thead>
            <tr>
                <th>Tipo</th>
                <th>Usuário</th>
                <th>Data</th>
                <th>
                    <div class="flex items-center flex-col justify-center">Coins</div>
                </th>
{{--                <th>Ações</th>--}}
            </tr>
            </thead>

            <tbody>
            @foreach($response->coins as $itemCoin)
                <tr>
                    <td>{{ $itemCoin['type'] }}</td>
                    <td>{{ $itemCoin['user']['name'] }}</td>
                    <td>{{ formatDateAndTime($itemCoin['created_at'] )}}</td>
                    <td>
                        <div class="flex items-center flex-col justify-center">
                            <img src="{{ url('img/coins.png') }}" class="w-5 h-5" alt="Coins" >
                            <p class="text-xs">{{ $itemCoin['coins'] ? formatCoin($itemCoin['$itemCoin']) : 0}}</p>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if($pageSize)
        <div class="flex justify-between text-black gap-2 py-5 text-gray-600 text-sm">
            <div class="flex items-center gap-2">
                Mostrando  <x-native-select
                    :options="['10', '15', '20', '30']"
                    wire:model="pageSize"
                />
                de {{ $response->coins->total() }}
                itens
            </div>
            <div>
                {{ $response->coins->links() }}
            </div>
        </div>
            @endif
    </x-card>
</div>
