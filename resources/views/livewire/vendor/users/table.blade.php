<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Função</th>
            <th>Status</th>
            <th>Data de Cadastro</th>
            <th>Cor Legenda</th>
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
                <td>
                    @if($itemUser['role'])
                        {{ $itemUser['role']['name'] }}
                    @endif
                </td>
                <td>
                    <div class="flex items-center gap-1">
                        <span @class([ $itemUser['status'] == 'Ativo' ? 'rounded-full bg-green-600 border-4 border-green-200 w-1 p-2' : 'rounded-full bg-red-600 border-4 border-red-200 w-1 p-2'])>

                        </span>
                        {{ $itemUser['status'] }}
                    </div>
                </td>
                <td>{{ formatDate($itemUser['created_at']) }}</td>
                <td><x-badge color="red" label="Black" /></td>
                <td width="150px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
                        @canany(['tenant_edit_user', 'admin_edit_user'])
                            <x-button.circle wire:click="openModal('vendor.users.form', {'id': {{ $itemUser['id'] }} } )" primary icon="pencil" />
                        @endcanany
                        @canany(['tenant_delete_user', 'admin_delete_user'])
                            <x-button.circle negative icon="x-circle" wire:click="openConfirmModal({{ $itemUser['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar o seguinte o registro, {{ $itemUser['name'] }} ?', 'confirmDeleteUser')" />
                        @endcanany
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
            de {{ $response->users->total() }}
            itens
        </div>
        <div>
            {{ $response->users->links() }}
        </div>
    </div>
</div>

