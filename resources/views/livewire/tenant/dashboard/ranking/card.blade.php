<div class="col-span-12 justify-center ">
    <x-card padding="0" >
        <x-slot name="header">
            <div class="flex flex-col justify-center items-center bg-green-500 text-white rounded-t gap-1 py-2">
                <p class="text-white">Ranking do mês</p>
                <p class="text-white">Meta : {{ $coins }}</p>
            </div>
        </x-slot>
        <div class="p-2">
            @foreach($response->users as $key => $itemUser)
            <div class="flex items-center justify-normal mt-3">
                <div class="relative ">
                    @if ($itemUser['image'] != null)
                        <img class="w-10 h-10 rounded-full" src="{{ url('storage/'.$itemUser['image']) }}" alt="Imagem Perfil">
                    @else
                        <img class="w-10 h-10 rounded-full"  src="{{ url('img/user-default.png') }}" alt="Imagem Perfil" >
                     @endif
                    <span class="bottom-0 left-7 absolute w-5 h-5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full text-center text-xs text-white">{{$key += 1}}</span>
                </div>
                <div class="w-32 pl-4">
                    <h1 class="text-xs font-medium">{{ firstName($itemUser['name']) }}</h1>
                    <p class="text-xs">{{ $itemUser['role']['name'] }}</p>
                </div>
                <div class="flex items-center flex-col justify-center">
                    <img src="{{ url('img/coins.png') }}" class="w-5 h-5" alt="Coins" >
                    <p class="text-xs">{{ $itemUser['coins'] ? formatCoin($itemUser['coins']) : 0}}</p>
                </div>
            </div>
            <div class="py-2 mb-2 border-b">
                <div class="mb-1 h-2 w-full rounded-l-lg rounded-r-lg bg-neutral-200 dark:bg-neutral-600">
                    <div class="h-2 rounded-l-lg rounded-r-lg bg-green-500" style="width: {{ round(($itemUser['coins'] * 100) / $coins) }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </x-card>
</div>
