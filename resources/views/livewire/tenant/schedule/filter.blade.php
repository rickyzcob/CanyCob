<div>
    <div class="flex flex-col gap-5 " >
        <x-card cardClasses="bg-primary-color border-l-4 border-orange-600">
            <div class="flex items-start justify-between border-b-2 mb-2">
                <h1 class="text-base text-gray-600 font-semibold py-1">Usuários</h1>
            </div>
            @foreach($response->users as $itemUser)
                <div class="gap-2">
                    <div style="border: 3px solid ; border-color: hsl({{ $itemUser['color'] }}); border-radius: 99px; margin-top: 5px;
  margin-bottom: 5px; ">
                        <div class="w-52">
                            <input type="checkbox" id="{{$itemUser['id']}}" value="{{$itemUser['id']}}" wire:model="state.user_id"  class="peer hidden w-full" />
                            <label for="{{$itemUser['id']}}" class=" select-none cursor-pointer
py-0.5 px-5 text-sm text-gray-500 transition-colors duration-200 ease-in-out peer-checked:bg-gray-200 rounded-full w-52 peer-checked:text-gray-900 ">{{ $itemUser['name']}}</label>
                        </div>
                    </div>
                </div>

            @endforeach
        </x-card>
    </div>
</div>
