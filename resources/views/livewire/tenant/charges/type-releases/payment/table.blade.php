<div>
    <x-card cardClasses="border-l-4 border-blue-500">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <div class="flex items-center text-base text-blue-500 font-bold gap-x-2">
                <span class="material-icons text-base ">currency_exchange</span>
                <h1 class="text-base py-1">Lançamentos gerados para : </h1> <x-badge color="{{$typeRelease['typeRelease']['color']}}" label="Total em {{$typeRelease['typeRelease']['name']}}" />
            </div>
            <x-button wire:click="openModal('tenant.charges.type-releases.payment.form', {'id' : {{$typeRelease['id']}} }, 2)" positive xs icon="plus-circle" label="Novo"/>
        </div>
        <div style="overflow-x:auto;">
            <table class="tables_price">
                <thead>
                    <tr>
                        <th width="100px">Nome</th>
                        <th width="200"> Forma de Pagamento</th>
                        <th>Valor</th>
                        <th>Vencimento</th>
                        <th width="90px">Status</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($response->releases as $itemRelease)
                    <tr>
                        <td><x-badge color="{{$itemRelease['typeRelease']['color']}}" label="{{$itemRelease['typeRelease']['name']}}" /></td>
                        <td> {{$itemRelease['type'] }}</td>
                        <td>{{ formatMoney($itemRelease['amount'] )}}</td>
                        <td>{{ formatDate($itemRelease['due_date'] ) }}</td>
                        <td><x-badge color="{{$itemRelease['status']['color']}}" label="{{$itemRelease['status']['name']}}" /></td>
                        @empty

                        <td colspan="5">
                            Sem Lançamentos
                        </td>

                    </tr>
                @endforelse

                </tbody>

                </tbody>

            </table>
            <div class="flex justify-between text-black gap-2 py-5 text-gray-600 text-sm">
                <div class="flex items-center gap-2">
                    Mostrando  <x-native-select
                        :options="['10', '15', '20', '30']"
                        wire:model="pageSize"
                    />
                    de {{ $response->releases->total() }}
                    itens
                </div>
                <div>
                    {{ $response->releases->links() }}
                </div>
            </div>
        </div>
    </x-card>
</div>

