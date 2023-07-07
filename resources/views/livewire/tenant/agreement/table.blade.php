<div style="overflow-x:auto;">
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Referencia</th>
            <th>CNPJ</th>
            <th>Valor</th>
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
                <td>{{ $itemAgreement['reference'] }}</td>
                <td>{{ $itemAgreement['franchising']['cnpj'] }}</td>
                <td> {{ formatMoney($itemAgreement['agreements_amount']) }}</td>
                <td> <x-badge outline color="{{$itemAgreement['status']['color']}}" label="{{$itemAgreement['status']['name']}}" /></td>

                <td width="250px">
                    <div class="flex flex-wrap justify-items-center gap-x-2">
                        @can('view_contract_agreement')
                            <x-button a href="{{route('agreement.show',['subdomain' => session('tenant')['subdomain'], 'reference' => $itemAgreement['reference'] ])}}" sm gray icon="eye" primary />
                        @endcan
                        @can('view_releases_agreement')
                            <x-button sm teal icon="cash" primary wire:click="openModal('tenant.agreement.releases.table', {'id': {{ $itemAgreement['id'] }} } )"/>
                        @endcan
                        @can('view_details_agreement')
                            <x-button sm warning icon="information-circle" wire:click="openModal('tenant.agreement.info.card', {'id': {{ $itemAgreement['id'] }} } )"/>
                        @endcan

                        @if( $itemAgreement['generate_document'] != 1)
                            @can('view_details_agreement')
                            <x-button sm info icon="document-add" wire:click="generateDocument({{ $itemAgreement['id'] }})" spinner="generateDocument"/>
                            @endcan

                            @elseif($itemAgreement['sent'] != 1)
                                @can('send_term_agreement')
                                <x-button sm purple icon="arrow-circle-up" wire:click="sendEmail({{ $itemAgreement['id'] }})" spinner="sendEmail"/>
                                @endcan

                            @elseif ($itemAgreement['sent'] == 1 && $itemAgreement['status_id'] != 5)

                            @can('send_term_agreement')
                                <x-button sm green icon="check" wire:click="changeStatus({{ $itemAgreement['id'] }}, 5)" spinner="changeStatus"/>
                            @endcan
                        @endif

                        @if(auth()->user()->tenant->type_agreement == 'Normal')
                            @can('download_term_agreement')
                                <x-button sm red icon="document-download" wire:click="downloadDocument({{ $itemAgreement['id'] }})"/>
                            @endcan
                        @endif
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


