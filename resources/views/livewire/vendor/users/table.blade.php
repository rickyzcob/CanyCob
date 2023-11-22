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
                        <div style="border: 3px solid ; border-color: hsl({{ $itemUser->color }}); border-radius: 99px;">
                            @if($itemUser->image == null)
                           <img class="rounded-full w-10 h-10" src="{{ url('img/user-default.png') }}">
                            @else
                                <img class="rounded-full w-10 h-10" src="{{  url('storage/'.$itemUser->image) }}">
                            @endif
                        </div>
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
                            <x-button.circle wire:click="openModal('vendor.users.form', {'id': {{ $itemUser['id'] }} } )" orange icon="pencil-alt" />
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

