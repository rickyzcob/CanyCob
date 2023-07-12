<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Coins</th>
            <div class="justify-items-center">
                <th>Açoes</th>
            </div>
        </tr>
        </thead>

        <tbody>
        @foreach($response->users as $itemUser)
            <tr>
                <td>
                    <div class="flex items-center gap-2">
                    @if($itemUser->image == null)
                        <x-avatar md  src="{{ url('img/user-default.png') }}" />
                    @else
                        <x-avatar md src="{{ url('storage/'.$itemUser->image) }}" />
                    @endif
                    {{ $itemUser['name'] }}
                    </div>
                </td>
                <td>{{ $itemUser['email'] }}</td>
                <td>{{ $itemUser['phone'] }}</td>
                <td>
                    <div class="flex items-center flex-col justify-center">
                        <img src="{{ url('img/coins.png') }}" class="w-5 h-5" alt="Coins" >
                        <p class="text-xs">{{ $itemUser['coins'] ? formatCoin($itemUser['coins']) : 0}}</p>
                    </div>
                </td>
                <td width="150px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
                        <x-button.circle wire:click="openModal('tenant.ranking.historic', {'id': {{ $itemUser['id'] }} } )" orange icon="document-report" /></div>
                </td>
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
            de {{ $response->users->total() }}
            itens
        </div>
        <div>
            {{ $response->users->links() }}
        </div>
    </div>
</div>



