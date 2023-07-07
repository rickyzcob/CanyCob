<div>
    <x-card cardClasses="md:h-52 border-l-4 border-blue-500">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <h1 class="text-base text-gray-600 font-semibold py-2 ">Informações</h1>
            @if($response->charge['agreement'] == 0)
                @can('change_precification_charges')
            <x-button wire:click="openModal('tenant.charges.precificate.form', {'charge_id': {{$response->charge['id']}} })" info sm icon="information-circle" label="Atualizar Valores"/>
                @endcan
            @endif
        </div>
        <div class="flex items-start justify-between mb-2">
            <div class="justify-between items-center w-1/2">
                <p> <span class="font-bold"> Valor Original : </span>{{formatMoney($response->charge['total_amount'])}}</p>
                <p> <span class="font-bold"> Valor Corrigido : </span> {{formatMoney($response->charge['total_amount_corrected'])}} </p>
                <p> <span class="font-bold"> Total de Cobranças : </span> {{ $response->charge['totalHistorics']->count('id')}} </p>
            </div>
            <div>
                <p> <span class="font-bold"> Ultima Atualização : </span> {{formatDate($response->charge['updated_at'])}} </p>
                <p> <span class="font-bold"> Total de Lançamentos : </span> {{ $response->charge['releases']->count('id') }} </p>
                <p class="pb-3"> <span class="font-bold"> Propostas Emitidas: </span> {{ $response->charge['proposals']->count('id') }} </p>
            </div>
        </div>
        <div class="flex items-start justify-between mb-2">
            @if($response->lastHistoric)
                <p> <span class="font-bold"> Última Cobrança : </span> {{formatDateAndTime($response->charge['historics'][0]['created_at'])}} via
                    <span class="font-bold"> {{$response->charge['historics'][0]['type']}}  </span> </p>
            @else
                <p> <span class="font-bold"> Sem Histórico : </span> </p>
            @endif
        </div>
    </x-card>
</div>
