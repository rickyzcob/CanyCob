<div>
    <x-card cardClasses="border-l-4 border-green-500">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <div class="flex items-center text-base text-green-500 font-bold gap-x-2">
                <span class="material-icons text-base ">currency_exchange</span>
                <h1 class="text-base  py-1">Tipo de Pagamentos para :  </h1> <x-badge color="{{$typeRelease['color']}}" label="{{$typeRelease['name']}}" />
            </div>
{{--                @can('change_precification_charges')--}}
                    <x-button wire:click="openModal('tenant.type-releases.payment-method.form', {'type_release_id' : {{$typeRelease['id']}} }, 2)" positive xs icon="plus-circle" label="cadastrar"/>
{{--                @endcan--}}
        </div>
        <table class="tables_price">
            <thead>
                <tr>
                    <th width="300">Tipo</th>
                    <th>Codigo</th>
                    <th>Banco</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach($response->paymentMethod as $itemPayment)
                <tr>
                    <td>{{ $itemPayment['type'] }}</td>
                    <td>{{ $itemPayment['code'] }}</td>
                    <td>{{ $itemPayment['bank'] }}</td>
                    <td>{{ $itemPayment['status'] }}</td>
                    <td>
                        <x-button.circle xs warning icon="pencil-alt" wire:click="openModal('tenant.type-releases.payment-method.form', {'id' : {{$itemPayment['id']}} }, 2)"  />
                        <x-button.circle xs negative icon="x-circle" wire:click="openConfirmModal({{ $itemPayment['id'] }}, 'Apagar Registro' , 'Você tem certeza que deseja apagar o seguinte o registro, {{ $itemPayment['type'] }}  do banco {{ $itemPayment['bank'] }}?', 'confirmDeletePaymentMethod')" />
                    </td>
                </tr>
            @endforeach
            </tbody>
            </tbody>
        </table>
    </x-card>
</div>
