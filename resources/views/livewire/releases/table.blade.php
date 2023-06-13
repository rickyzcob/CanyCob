<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Unidade</th>
            <th>CNPJ</th>
            <th>Valor</th>
            <th>Valor Corrigido</th>
            <th>Vencimento</th>
            <div class="justify-items-center">
                <th>Açoes</th>
            </div>
        </tr>
        </thead>

        <tbody>
        @foreach($response->releases as $itemRelease)
            <tr>
                <td> {{ $itemRelease['name'] }} </td>
                <td> @if ($itemRelease['franchising'])
                        {{ $itemRelease['franchising']['name'] }}
                    @else
                    Sem Nome
                    @endif
                </td>
                <td> {{ $itemRelease['cnpj'] }} </td>
                <td> {{ formatMoney($itemRelease['amount'] )}} </td>
                <td> {{ formatMoney($itemRelease['amount_corrected'] )}} </td>
                <td> {{ formatDate($itemRelease['due_date']) }} </td>
                <td width="150px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
                        @can('edit_releases')
                        <x-button.circle warning wire:click="openModal('chargestatuses.form', {'id': null } )" warning icon="pencil-alt" />
                        @endcan
                        @can('delete_releases')
                        <x-button.circle negative icon="x-circle" wire:click="openConfirmModal({{ $itemRelease['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar o seguinte o registro, {{ $itemRelease['name'] }} ?', 'confirmDeleteChargeStatus')" />
                        @endcan
                    </div>
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
            de {{ $response->releases->total() }}
            itens
        </div>
        <div>
            {{ $response->releases->links() }}
        </div>
    </div>
</div>




