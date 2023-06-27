<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <div class="justify-items-center">
                <th>Açoes</th>
            </div>
        </tr>
        </thead>

        <tbody>
        @foreach($response->roles as $itemRole)
            <tr>
                <td>{{ $itemRole['name'] }}</td>
                <td width="150px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
{{--                        @can('tenant_roles_permission')--}}
                        <x-button.circle wire:click="openModal('vendor.permissions.roles', {'id': {{ $itemRole['id'] }} } )"  positive icon="archive" />
{{--                        @endcan--}}
{{--                        @can('tenant_edit_permission')--}}
                        <x-button.circle wire:click="openModal('vendor.permissions.form', {'id': {{ $itemRole['id'] }} } )" warning icon="pencil-alt" />
{{--                        @endcan--}}
{{--                        @can('tenant_delete_permission')--}}
                        <x-button.circle negative icon="x-circle" wire:click="openConfirmModal({{ $itemRole['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar o seguinte o registro, {{ $itemRole['name'] }} ?', 'confirmDeleteRole')" />
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
            de {{ $response->roles->total() }}
            itens
        </div>
        <div>
            {{ $response->roles->links() }}
        </div>
    </div>
</div>
