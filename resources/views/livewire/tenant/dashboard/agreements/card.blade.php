<div>
    <x-card cardClasses="h-82 border-l-4 border-violet-600">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <h1 class="text-base text-gray-600 font-semibold py-2">Acompanhamento de Propostas Emitidas</h1>
        </div>
        <div class="scrollbar" id="style-1">
            <ul class="max-w-full flex flex-col">
                @foreach($response->agreements as $itemAgreement)
                    <div class="flex items-center justify-between gap-x-2 py-3 px-2 text-sm font-medium odd:bg-gray-100 bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:odd:bg-slate-800 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                        <div>
                            <div> {{ $itemAgreement['franchising']['name'] }}</div>
                            <div class="text-sm leading-4 font-normal"> Acordo gerado em  : {{ formatDate($itemAgreement['created_at'] ) }}</div>
                            <div>No valor de {{ formatMoney($itemAgreement['agreements_amount']) }} em {{ $itemAgreement['installments'] }} x de {{ formatMoney($itemAgreement['installment_value']) }} </div>
                        </div>
                        <div>
                            <x-badge outline color="{{$itemAgreement['status']['color']}}" label="{{$itemAgreement['status']['name']}}" />
                        </div>
                    </div>
                @endforeach
            </ul>
        </div>
    </x-card>
</div>

