<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>Valor Devido</th>
            <th>Status</th>
            <div class="justify-items-center">
                <th>Açoes</th>
            </div>
        </tr>
        </thead>

        <tbody>
        @foreach($response->agreements as $itemAgreement)
            <tr>
                <td>{{ $itemAgreement['franchising']['name'] }}</td>
                <td>{{ $itemAgreement['franchising']['cnpj'] }}</td>
                <td> {{ formatMoney($itemAgreement['total_amount']) }}</td>
                <td> <x-badge outline color="{{$itemAgreement['status']['color']}}" label="{{$itemAgreement['status']['name']}}" /></td>

                <td width="250px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
                        <x-button a href="{{route('agreement.show', $itemAgreement['reference'])}}" sm gray icon="eye" primary />
                        <x-button sm teal icon="cash" primary wire:click="openModal('agreement.releases.table', {'id': {{ $itemAgreement['id'] }} } )"/>
                        <x-button sm warning icon="information-circle" wire:click="openModal('agreement.info.card', {'id': {{ $itemAgreement['id'] }} } )"/>
                        @if($itemAgreement['generate_document'] != 1)
                        <x-button sm info icon="document-add" wire:click="generateDocument({{ $itemAgreement['id'] }})" spinner="generateDocument"/>
                        @else
                            <x-button sm purple icon="arrow-circle-up" wire:click="sendEmail({{ $itemAgreement['id'] }})" spinner="sendEmail"/>
{{--                            <x-button sm emerald icon="phone-outgoing" wire:click="sendWhatsapp({{ $itemAgreement['id'] }})" spinner="generateDocument"/>--}}
                        @endif
                            <x-button sm red icon="document-download" wire:click="openModal('agreement.info.card', {'id': {{ $itemAgreement['id'] }} } )"/>
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
            de {{ $response->agreements->total() }}
            itens
        </div>
        <div>
            {{ $response->agreements->links() }}
        </div>
    </div>
</div>


