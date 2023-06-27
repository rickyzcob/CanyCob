<div>
    <div class="flex flex-wrap items-center justify-center">
        @foreach($response->humor as $itemHumor)
            <div
            @class([
        'flex-shrink-0 m-6 relative overflow-hidden rounded-lg max-w-xs shadow-lg',
    'bg-red-500' => $itemHumor['humor'] == 1,
    'bg-orange-500' => $itemHumor['humor'] == 2,
    'bg-yellow-500' => $itemHumor['humor'] == 3,
    'bg-blue-500' => $itemHumor['humor'] == 4,
    'bg-teal-500' => $itemHumor['humor'] == 5,
    ])
            >
                <svg class="absolute bottom-0 left-0 mb-8" viewBox="0 0 375 283" fill="none" style="transform: scale(1.5); opacity: 0.1;">
                    <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white"/>
                    <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white"/>
                </svg>
                <div class="relative pt-10 px-10 flex items-center justify-center">
                    <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3" style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;"></div>
                    @if ($itemHumor['user']['image'] != null)
                        <img class="w-40 rounded-full" src="{{ url('storage/'.$itemHumor['user']['image']) }}" alt="Imagem Perfil">
                    @else
                        <img class="w-40 rounded-full"  src="{{ url('img/user-default.png') }}" alt="Imagem Perfil" >
                    @endif
                    <span class="bottom-0 left-36 absolute w-16 h-16 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full text-center text-xs text-white">
                    <img class="w-40 rounded-full"  src="{{ url('img/emojis/emoji_'.$itemHumor['humor'].'.png') }}" alt="Imagem Perfil" >
                </span>
                </div>
                <div class="relative text-white px-6 pb-6 mt-6">
                    <span class="block opacity-75 -mb-1">{{ $itemHumor['user']['name'] }}</span>
                    <div class="flex items-center justify-between">
                        <span class="block font-semibold text-xl">{{ $itemHumor['user']['role']['name'] }}</span>
                        @if($itemHumor['description'])
                            <x-button.circle white icon="eye" wire:click="openCentralModal('tenant.humor.description', 'Descrição do Colaborador' , 'Oba! parece que {{ $itemHumor['user']['name'] }} tem algo a dizer ..', {id : {{ $itemHumor['id'] }}}, 'closeCentralModal')" />
                        @endif
                </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
