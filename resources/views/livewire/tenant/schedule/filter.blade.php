<div>
    <div class="flex flex-col gap-5 " >
        <x-card cardClasses="bg-primary-color border-l-4 border-orange-600">
            <div class="flex items-start justify-between border-b-2 mb-2">
                <h1 class="text-base text-gray-600 font-semibold py-1">Usuários</h1>
            </div>
            @foreach($response->users as $itemUser)
                <div class="py-1 w-52">
                    <div class="flex items-center gap-2">
                        <div style="border: 3px solid ; border-color: hsl({{ $itemUser['color'] }}); border-radius: 99px;">
                            @if($itemUser['image'] == null)
                                <img class="rounded-full w-6 h-6" src="{{ url('img/user-default.png') }}">
                            @else
                                <img class="rounded-full w-6 h-6" src="{{  url('storage/'.$itemUser['image']) }}">
                            @endif
                        </div>
                        <div>
                            <input type="checkbox" id="{{$itemUser['id']}}" value="{{$itemUser['id']}}" wire:model="state.user_id"  class="peer hidden w-full" />
                            <label for="{{$itemUser['id']}}" class=" w-full select-none cursor-pointer rounded-tr-full rounded-br-full rounded-bl-full border border-gray-400
py-1 px-2 text-xs text-gray-500 transition-colors duration-200 ease-in-out peer-checked:bg-gray-200 peer-checked:text-gray-900 peer-checked:border-gray-200 ">{{ $itemUser['name']}}
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
        </x-card>
    </div>
</div>
