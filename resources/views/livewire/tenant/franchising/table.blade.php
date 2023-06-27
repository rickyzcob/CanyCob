<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Atendente</th>
            <th>Em Dia ?</th>
            <th>Telefone</th>
            <th>Status</th>
            <th>Ativo</th>
            <div class="justify-items-center w-auto">
                <th>Açoes</th>
            </div>
        </tr>
        </thead>

        <tbody>
        @foreach($response->franchisings as $itemPaymentFranchising)
            <tr>
                <td>{{ $itemPaymentFranchising['id'] }} - {{ $itemPaymentFranchising['name'] }}</td>
                <td> {{ $itemPaymentFranchising['attendant'] ? $itemPaymentFranchising['attendant']['name'] : 'Sem Atendente' }}</td>
                <td>Sim</td>
                <td>{{ $itemPaymentFranchising['phone01'] }}</td>
                <td> @if ($itemPaymentFranchising['statusFran'])  <x-badge color="{{$itemPaymentFranchising['statusFran']['color']}}"  label=" {{ $itemPaymentFranchising['statusFran']['name'] }}" />  @else <x-badge secondary label="Sem Status" /> @endif</td>
                <td>{{ $itemPaymentFranchising['status'] }}</td>
                <td width="250px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
                        <x-button sm gray icon="eye" primary />
                        <x-button sm blue icon="user-circle" primary wire:click="openModal('tenant.franchising.partners.table', {'id': {{ $itemPaymentFranchising['id'] }} } )"/>
                        <x-button sm orange icon="user" primary wire:click="openModal('tenant.franchising.contacts.table', {'id': {{ $itemPaymentFranchising['id'] }} } )"/>
                        <x-button sm warning icon="pencil-alt" wire:click="openModal('tenant.franchising.form', {'id': {{ $itemPaymentFranchising['id'] }} } )" />
                        <x-button sm wire:click="$emit('showDeleteModal', {{ $itemPaymentFranchising['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar o seguinte o registro, {{ $itemPaymentFranchising['name'] }} ?')" negative icon="x" />
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="flex justify-between text-black gap-2 py-5 text-gray-600 text-sm">
        <div class="flex items-center gap-2">
            Mostrando  <x-native-select
                :options="['10', '15', '20', '30', '60']"
                wire:model="pageSize"
            />
            de {{ $response->franchisings->total() }}
            itens
        </div>
        <div>
            {{ $response->franchisings->links() }}
        </div>
    </div>
</div>

