<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Porcentagem</th>
                <th>Calculo Automatico</th>
                <th>Status</th>
                <div class="justify-items-center">
                    <th>Açoes</th>
                </div>
            </tr>
        </thead>

        <tbody>
        @foreach($response->fees as $itemFees)
            <tr>
                <td>{{ $itemFees['name'] }}</td>
                <td>{{ $itemFees['type'] }}</td>
                <td>{{ $itemFees['value'] }} %</td>
                <td>{{ $itemFees['automatic'] }}</td>
                <td> <div class="flex items-center gap-1">
                        <span @class([ $itemFees['status'] == 'Ativo' ? 'rounded-full bg-green-600 border-4 border-green-200 w-1 p-2' : 'rounded-full bg-red-600 border-4 border-red-200 w-1 p-2'])>

                        </span>
                        {{ $itemFees['status'] }}
                    </div>
                </td>
                <td width="150px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
                        @can('edit_fees')
                        <x-button.circle warning wire:click="openModal('tenant.fees.form', {'id': {{ $itemFees['id'] }} } )" warning icon="pencil-alt" />
                        @endcan
                        @can('delete_fees')
                        <x-button.circle negative icon="x-circle" wire:click="openConfirmModal({{ $itemFees['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar o seguinte o registro, {{ $itemFees['name'] }} ?', 'confirmDeleteFees')" />
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
            de {{ $response->fees->total() }}
            itens
        </div>
        <div>
            {{ $response->fees->links() }}
        </div>
    </div>
</div>




