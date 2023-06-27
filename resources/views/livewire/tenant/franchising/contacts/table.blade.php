<div>
    <x-card>
        <div class="flex items-start justify-between border-b-2 mb-2 py-2">
            <h1 class="text-lg text-gray-600 font-semibold">Lista de Funcionários da unidade : {{ $franchising['name'] }}</h1>
            <x-button wire:click="openModal('tenant.franchising.contacts.form', {'franchising_id': {{$franchising['id']}} }, 2)" positive icon="plus-circle" label="Adicionar"/>
        </div>
        <table class="tables" style="overflow-x:auto;">
            <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <div class="justify-items-center">
                    <th>Açoes</th>
                </div>
            </tr>
            </thead>
            <tbody>
            @foreach($response->contacts as $itemContact)
                <tr>
                    <td>{{ $itemContact['name'] }}</td>
                    <td>{{ $itemContact['email'] }}</td>
                    <td>{{ $itemContact['phone'] }}</td>
                    <td width="110px">
                        <div class="flex flex-wrap justify-items-center gap-x-2">
                            <x-button sm warning icon="pencil-alt" wire:click="openModal('tenant.franchising.contacts.form', {'id': {{$itemContact['id']}} }, 2)" />
                            <x-button sm negative icon="user-remove" wire:click="openConfirmModal({{ $itemContact['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar o seguinte o registro, {{ $itemContact['name'] }} ?', 'confirmDeleteContact')" />
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-card>
</div>


