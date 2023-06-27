<div>
    <x-card>
        <div class="flex items-start justify-between border-b-2 mb-2 py-2">
            <h1 class="text-lg text-gray-600 font-semibold">Lista de Sócios da unidade : {{ $franchising['name'] }}</h1>
            <x-button wire:click="openModal('tenant.franchising.partners.form', {'id': {{$franchising['id']}} }, 2)" positive icon="plus-circle" label="Adicionar"/>
        </div>
        <table class="tables" style="overflow-x:auto;">
            <thead>
            <tr>
                <th>Nome</th>
{{--                <th>Email</th>--}}
                <th>CPF</th>
                <th>Telefone</th>

                <div class="justify-items-center">
                    <th>Açoes</th>
                </div>
            </tr>
            </thead>

            <tbody>
            @foreach($response->partners as $itemPartner)
                <tr>
                    <td>{{ $itemPartner['partner']['name'] }}</td>
{{--                    <td>{{ $itemPartner['partner']['email'] }}</td>--}}
                    <td>{{ $itemPartner['partner']['cpf'] }}</td>
                    <td>{{ $itemPartner['partner']['phone'] }}</td>

                    <td width="15px">
                        <div class="flex flex-wrap justify-items-center gap-x-2">
                            <x-button sm wire:click="$emit('showDeleteModal', {{ $itemPartner['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar o seguinte o registro, {{ $itemPartner['partner']['name'] }} ?')" negative icon="x" />
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </x-card>
</div>

