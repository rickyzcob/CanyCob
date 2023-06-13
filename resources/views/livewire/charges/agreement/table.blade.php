<div>
    @if($response->agreement)
        <div class="pb-5">
            <x-card cardClasses="h-42 border-l-4 border-orange-600">
                    <ul class="max-w-full flex flex-col">
                        <div class="flex items-center justify-between gap-x-2 py-3 px-2 text-sm font-medium odd:bg-gray-100 bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:odd:bg-slate-800 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                            <div>
                                Acordo  {{ $response->agreement['id'] }}
                                <div class="text-sm leading-4 font-normal">Acordo gerado em  : {{ formatDate($response->agreement['created_at'] ) }} no valor de {{ formatMoney($response->agreement['agreements_amount']) }} em {{ $response->agreement['installments'] }} vezes de {{ formatMoney($response->agreement['installment_value']) }} </div>
                            </div>
                            <div>
                                <x-badge outline color="{{$response->agreement['status']['color']}}" label="{{$response->agreement['status']['name']}}" />
                            </div>
                        </div>
                    </ul>
            </x-card>
        </div>
    @endif
</div>
