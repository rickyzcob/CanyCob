<div style="overflow-x:auto;">
    <x-card>
    <table class="tables">
        <thead>
        <tr>
            <th>Nome</th>
            <div class="justify-items-center">
                <th>Açoes</th>
            </div>
        </tr>
        </thead>
        <tbody>
        @foreach($response->users as $itemUser)
            <tr>
                <td>
                    <div class="flex items-center gap-2">
                        <div style="border: 3px solid ; border-color: hsl({{ $itemUser['user']['color'] }}); border-radius: 99px;">
                            @if($itemUser['user']['image'] == null)
                                <img class="rounded-full w-10 h-10" src="{{ url('img/user-default.png') }}">
                            @else
                                <img class="rounded-full w-10 h-10" src="{{  url('storage/'.$itemUser['user']['image']) }}">
                            @endif
                        </div>
                    {{ $itemUser['user']['name'] }}
                    </div>
                </td>
                <td width="80px">
                    <x-button.circle wire:click="openModal('vendor.users.indicators02', {'id': {{ $itemUser['user']['id'] }} }, 2)" info icon="view-list" />
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </x-card>
</div>
