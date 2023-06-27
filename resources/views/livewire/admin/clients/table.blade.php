<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Proprietario</th>
            <th>Status</th>
            <th>Data de Cadastro</th>
            <div class="justify-items-center">
                <th>Açoes</th>
            </div>
        </tr>
        </thead>
        <tbody>
        @foreach($response->clients as $itemClient)
            <tr>
                <td>
                    <x-avatar size="w-18 h-18 text-2xl" label="AB" />
                    {{ $itemClient['name'] }}
                </td>
                <td> @if($itemClient['user'] )
                    {{ $itemClient['user']['name'] }}
                     @endif
                </td>
                <td>
                    <div class="flex items-center gap-1">
                        <span @class([ $itemClient['status'] == 'Ativo' ? 'rounded-full bg-green-600 border-4 border-green-200 w-1 p-2' : 'rounded-full bg-red-600 border-4 border-red-200 w-1 p-2'])>

                        </span>
                        {{ $itemClient['status'] }}
                    </div>
                </td>
                <td>{{ formatDate($itemClient['created_at']) }}</td>
                <td width="150px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
{{--                        @can('edit_user')--}}
                            <x-button.circle wire:click="openModal('admin.clients.form', {'id': {{ $itemClient['id'] }} } )" primary icon="pencil" />
{{--                        @endcan--}}
{{--                        @can('delete_user')--}}
                            <x-button.circle negative icon="x-circle" wire:click="openConfirmModal({{ $itemClient['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar o seguinte o registro, {{ $itemClient['name'] }} ?', 'confirmDeleteUser')" />
{{--                        @endcan--}}
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
            de {{ $response->clients->total() }}
            itens
        </div>
        <div>
            {{ $response->clients->links() }}
        </div>
    </div>
</div>


