<div>
    @if($visible)
    <div x-data="{ open: false }" class="relative">
        <div  @click="open = true" class="flex items-center justify-center text-white hover:bg-white hover:text-sky-700 h-14 w-14 cursor-pointer">
            <div
                class="absolute bottom-auto left-auto right-3 top-5 z-10 inline-block -translate-y-1/2 translate-x-2/4 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 whitespace-nowrap rounded-full bg-red-500 px-2 py-1 text-center align-baseline text-xs font-bold leading-none text-white">
                {{ $this->count }}
            </div>
            <span class="material-icons text-3xl ">notifications</span>
        </div>

        <div x-show="open"
             x-on:click.stop.outside="open = false"
             x-transition:enter.duration.500ms
             x-transition:leave.duration.800ms
             x-cloak
             class="absolute right-0 mt-2 bg-white rounded-br-lg rounded-bl-lg shadow-lg overflow-hidden z-20 w-72"  >
            <div class="scrollbar_notification" id="style-1">
                @forelse($response->notifications as $notification)
{{--                    @dd($notification['data'])--}}
                <div wire:click="markAsRead('{{ $notification['id'] }}', '{{$notification['data']['proposal']['proposal_accept']['id']}}')" class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2 cursor-pointer">
{{--                    <img class="h-8 w-8 rounded-full object-cover mx-1" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80" alt="avatar">--}}
                    <p class="text-gray-600 text-sm mx-2">
                        <span class="font-bold" href="#">{{ $notification['data']['proposal']['proposal_accept']['partner']['name'] }}</span>  da Unidade: {{ $notification['data']['proposal']['franchising']['name'] }}, Aceitou a proposta formal. {{ formatdiffForHumans($notification['created_at']) }}
                    </p>
                </div>
                @empty
                    <div class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2 cursor-pointer">
                        <p class="text-gray-600 text-sm mx-2">
                            <span class="font-bold" href="#"> Sem Notificações </span>
                        </p>
                    </div>
                @endforelse
            </div>
            <a href="{{ route('notifications.index') }}" class="block bg-sky-800 text-white text-center py-2">Ver Todas</a>
        </div>
        </div>
        @endif
    </div>
