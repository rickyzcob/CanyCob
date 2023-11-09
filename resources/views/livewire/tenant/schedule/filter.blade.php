<div>
    <div class="flex flex-col gap-5 " >
        <x-card cardClasses="bg-primary-color border-l-4 border-orange-600">
            <div class="flex items-start justify-between border-b-2 mb-2">
                <h1 class="text-base text-gray-600 font-semibold py-1">Filtros</h1>
            </div>
{{--            @foreach($response->orderStatus as $itemOrderStatus)--}}
{{--                <div class="py-2 w-52">--}}
{{--                    --}}{{--                        <x-checkbox lg id="{{$itemOrderStatus['id']}}" value="{{$itemOrderStatus['id']}}" label="{{ $itemOrderStatus['name']}}" wire:model="state.status_id" />--}}

{{--                    <input type="checkbox" id="{{$itemOrderStatus['id']}}" value="{{$itemOrderStatus['id']}}" wire:model="state.status_id" class="peer hidden w-full" />--}}
{{--                    <label for="{{$itemOrderStatus['id']}}" class=" select-none cursor-pointer rounded-tr-full rounded-br-full rounded-bl-full border border-gray-400--}}
{{--py-1 px-6 text-sm text-gray-500 transition-colors duration-200 ease-in-out peer-checked:bg-gray-200 peer-checked:text-gray-900 peer-checked:border-gray-200 ">{{ $itemOrderStatus['name']}}</label>--}}
{{--                </div>--}}
{{--            @endforeach--}}


            <div class="flex items-start justify-between border-b-2 mb-2">
                <h1 class="text-base text-gray-600 font-semibold py-1">Tipo de Caminhão</h1>
            </div>

{{--            @foreach($response->typeTrucks as $itemTypeTruck)--}}
{{--                <div class="py-2">--}}
{{--                    <x-checkbox lg id="{{$itemTypeTruck['id']}}" value="{{$itemTypeTruck['id']}}" label="{{ $itemTypeTruck['name']}}" wire:model="state.typetruck_id" />--}}
{{--                </div>--}}
{{--            @endforeach--}}


        </x-card>
    </div>
</div>
