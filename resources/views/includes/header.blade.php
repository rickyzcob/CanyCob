<header class="sticky top-0 z-20">
    <nav class="navbar navbar-expand-lg shadow-md relative flex bg-sky-700 items-center w-full h-14 justify-between ">
        <div class="container flex flex-wrap items-center justify-between mx-auto">

            <button @click="isMobileOpen = !isMobileOpen">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white lg:hidden" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <a href="#" class="flex items-center">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-10" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white text-white">Cobrança Fácil</span>
            </a>
    @include('includes.menu')
    @include('includes.mobile_menu')
            <div class="flex justify-center items-center ">
                @livewire('notifications.button', ['visible' => true])

                <div x-data="{ open: false }"  class="relative">
                    <div  @click="open = true" class="flex items-center text-white hover:bg-white hover:text-sky-700 p-4 h-14 w-14 cursor-pointer
            {{ request()->is('configuracoes*') ? 'text-sky-800 bg-white' : 'text-white' }}"
                          :class="{ 'text-sky-800 bg-white': open, 'text-white' : !open  }">
                        <span class="material-icons text-3xl text-center">account_box</span>
                    </div>
                    <div x-show="open"
                         x-on:click.stop.outside="open = false"
                         x-transition:enter.duration.500ms
                         x-transition:leave.duration.800ms
                         x-cloak
                         class="absolute z-40 w-52 py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl right-0">
                        <div class="flex flex-col items-center justify-center">
                            <div class="pt-5">
                                @if (auth()->user()->image != null)
                                    <img src="{{ url('storage/'.auth()->user()->image) }}" class="border-2 rounded-full w-20 h-20 " alt="{{ auth()->user()->image }}" >
                                @else
                                    <img src="{{ url('img/user-default.png') }}" class="border-2 rounded-full w-20 h-20" alt="{{ auth()->user()->image }}" >
                                @endif
                            </div>
                            <p class="p-5 text-lg text-center">

                                {{ auth()->user()->name }}

                            </p>

                        </div>

                        <a href="{{route('profile.index', auth()->user()->id)}}"
                           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20 text-center">
                            Configurações
                        </a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20 text-center text-lg">
                            Sair
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>


                @canany(['view_configuration', 'view_permission', 'view_user'])
                    <div x-data="{ open: false }"  class="relative">
                        <div  @click="open = true" class="flex items-center hover:bg-white hover:text-sky-700 p-4 h-14 w-14 cursor-pointer
                            {{ request()->is('configuracoes*') ? 'text-sky-800 bg-white' : 'text-white' }}"
                              :class="{ 'text-sky-800 bg-white': open, 'text-white' : !open  }">
                            <span class="material-icons text-3xl ">settings_applications</span>
                        </div>
                        <div x-show="open"
                             x-on:click.stop.outside="open = false"
                             x-transition:enter.duration.500ms
                             x-transition:leave.duration.800ms
                             x-cloak
                             class="absolute items-center z-40 w-72 py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl right-0">
                            @can('view_configuration')
                                <a href=""
                                   class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                                    <span class="material-icons text-base pr-2">display_settings</span>
                                    Cor e Logo
                                </a>
                            @endcan
                            @can('view_permission')
                                <a href="{{route('permissions.index')}}"
                                   class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                                    <span class="material-icons text-base pr-2">engineering</span>
                                    Permissões
                                </a>
                            @endcan
                            @can('view_user')
                                <a href="{{route('user.index')}}"
                                   class="block flex items-center px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                                    <span class="material-icons text-base pr-2">people</span>
                                    Usuários
                                </a>
                            @endcan
                        </div>
                    </div>
                @endcanany
                {{--@endif--}}
            </div>
        </div>
    </nav>

    <div class="h-2 {{ session('tenant')['color'] ?? 'bg-gray-500' }}"></div>
</header>

@push('scripts')
    <script>
        Echo.channel('notifications')
            .listen('ProposalAccept', (e) => {
                console.log(e);
            });
    </script>
@endpush
