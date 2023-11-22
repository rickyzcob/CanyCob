<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>CPF</th>
            <div class="justify-items-center">
                <th>Açoes</th>
            </div>
        </tr>
        </thead>

        <tbody>
        @foreach($response->partners as $itemPartner)
            <tr>
                <td>{{ $itemPartner['name'] }}</td>
                <td>{{ $itemPartner['email'] }}</td>
                <td>{{ $itemPartner['phone'] }}</td>
                <td>{{ formatCPFCNPJ($itemPartner['cpf']) }}</td>
                <td width="150px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
                        @can('tenant_edit_partner')
                            <x-button.circle wire:click="openModal('tenant.partners.form', {'id': {{ $itemPartner['id'] }} } )" orange icon="pencil-alt" />
                        @endcan
                        @can('tenant_delete_partner')
                            <x-button.circle wire:click="$emit('showDeleteModal', {{ $itemPartner['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar o seguinte o registro, {{ $itemPartner['name'] }} ?')" negative icon="x" />
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
            de {{ $response->partners->total() }}
            itens
        </div>
        <div>
            {{ $response->partners->links() }}
        </div>
    </div>
</div>


