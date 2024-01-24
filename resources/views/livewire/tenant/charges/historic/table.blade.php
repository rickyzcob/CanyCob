<div>
    <x-card cardClasses="h-80 border-l-4 border-green-500">
        <div class="flex items-start justify-between border-b-2 mb-2">
            <div class="flex items-center text-base text-green-500 font-bold gap-x-2">
                <span class="material-icons text-base ">summarize</span>
                <h1 class="text-base  py-1">Histórico de Cobranças</h1>
            </div>
        </div>
        <div class="scrollbar" id="style-1">
            <ul class="max-w-full flex flex-col">
                @foreach($response->historicReleases as $itemHistoric)
                    <div class="flex items-center justify-between gap-x-2 py-3 px-2 text-sm font-medium odd:bg-gray-100 bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:odd:bg-slate-800 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                        <div>
                            {{$itemHistoric['name']}} - {{ $itemHistoric['type'] }}
                            <div class="text-sm leading-4 font-normal"><span class="text-xs leading-4 font-normal text-gray-500">
                                    @if($itemHistoric['type'] == 'WhatsApp')
                                        Numero : {{ ($itemHistoric['whatsapp']) }}
                                    @elseif($itemHistoric['type'] == 'Email')
                                        Email : {{ ($itemHistoric['email']) }}
                                    @elseif($itemHistoric['type'] == 'Phone')
                                        Fone : {{ ($itemHistoric['phone']) }}
                                    @endif

                                </span> </div>
                            <div class="text-[8px] leading-4 font-normal"><span class="text-xs leading-4 font-normal text-gray-500"> Data : {{ formatDateAndTime($itemHistoric['created_at']) }}</span> </div>
                        </div>
                        <div>
                            @if($itemHistoric['description'])
                                <x-button.circle xs info icon="eye" wire:click="openCentralModal('tenant.charges.historic.description', 'Descrição da conversa' , 'Descrição do contato telefonico', {id : {{ $itemHistoric['id'] }}}, 'closeCentralModal')" />
                            @endif
                        </div>
                    </div>
                @endforeach
            </ul>
        </div>
{{--        <div class="scrollbar" id="style-1">--}}
{{--            <table class="tables">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Tipo</th>--}}
{{--                    <th>Contato</th>--}}
{{--                    <th>Fone</th>--}}
{{--                    <div>--}}
{{--                        <th>Sucesso ?</th>--}}
{{--                    </div>--}}

{{--                </tr>--}}
{{--                </thead>--}}
{{--                    <tbody>--}}
{{--                        @foreach($response->historicReleases as $itemHistoric)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $itemHistoric['type'] }} </td>--}}
{{--                                <td>{{ $itemHistoric['name'] }}</td>--}}
{{--                                <td>{{ $itemHistoric['phone'] }}</td>--}}
{{--                                <td>{{ $itemHistoric['success'] }}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}

</x-card>
</div>
