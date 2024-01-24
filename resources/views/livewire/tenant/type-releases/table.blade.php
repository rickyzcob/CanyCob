<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Status</th>
            <div class="justify-items-center">
                <th>Açoes</th>
            </div>
        </tr>
        </thead>
        <tbody>

        @foreach($response->typeReleases as $itemTypeRelease)
            <tr>
                <td><x-badge color="{{$itemTypeRelease['color']}}" label="{{$itemTypeRelease['name']}}" /></td>
                <td> <div class="flex items-center gap-1">
                        <span @class([ $itemTypeRelease['status'] == 'Ativo' ? 'rounded-full bg-green-600 border-4 border-green-200 w-1 p-2' : 'rounded-full bg-red-600 border-4 border-red-200 w-1 p-2'])>

                        </span>

                        {{ $itemTypeRelease['status'] }}
                    </div>
                </td>
                <td width="150px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
                        <x-button.circle green wire:click="openModal('tenant.type-releases.payment-method.table', {'id': {{ $itemTypeRelease['id'] }} } )" icon="currency-dollar" />
                        <x-button.circle warning wire:click="openModal('tenant.type-releases.form', {'id': {{ $itemTypeRelease['id'] }} } )" icon="pencil-alt" />
                        <x-button.circle negative icon="x-circle" wire:click="openConfirmModal({{ $itemTypeRelease['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar o seguinte o registro, {{ $itemTypeRelease['name'] }} ?', 'confirmDeleteTypeReleases')" />
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
            de {{ $response->typeReleases->total() }}
            itens
        </div>
        <div>
            {{ $response->typeReleases->links() }}
        </div>
    </div>
</div>



