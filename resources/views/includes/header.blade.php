<header class="relative top-0 z-20 ">
    <nav class="fixed primary-color navbar navbar-expand-lg shadow-md flex items-center w-full h-16 justify-between border-b-8">
        <div class="container flex flex-wrap items-center justify-between mx-auto ">

            <button @click="isMobileOpen = !isMobileOpen">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 pl-2 primary-text-color lg:hidden" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="flex items-center pl-2">
                @if(session('tenant')['logo'] == null)
                    <span class="self-center text-xl font-semibold whitespace-nowrap primary-text-color">{{ session('tenant')['name'] }}</span>
                @else
                    <img src="{{ asset('storage/'.session('tenant')['logo']) }}" class="h-6 mr-3 sm:h-10"  alt="{{ auth()->user()->tenant->name }}" >
                @endif
            </div>

            @if(auth()->user()->tenant->scope == 'Cliente')
                @include('tenant.menu.menu')
                @include('tenant.menu.mobile_menu')
            @elseif(auth()->user()->tenant->scope == 'Admin')
                @include('admin.menu.menu')
                @include('admin.menu.mobile_menu')
            @endif

            <div class="flex justify-center items-center ">

                @livewire('vendor.notifications.button', ['visible' => true])

                <div x-data="{ open: false }"  class="relative">
                    <div  @click="open = true" class="flex items-center justify-center primary-text-color h-14 w-14 cursor-pointer
                            {{ request()->is('meu-perfil') ? 'primary-text-active primary-active' : 'primary-text-color' }}"
                          :class="{ 'primary-text-color-active primary-color-active': open }">
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
                            <div class="p-5">
                                <p class="text-lg text-center">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-base text-center">
                                    @if(auth()->user()->role)
                                    {{ auth()->user()->role->name }}
                                    @endif
                                </p>
                            </div>


                        </div>

                        <a href="{{route('profile.index', session('tenant')['subdomain'], auth()->user()->id)}}"
                           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20 text-center">
                            Configurações
                        </a>
                        <a href="{{ route('logout', session('tenant')['subdomain']) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20 text-center text-lg">
                            Sair
                        </a>

                        <form id="logout-form" action="{{ route('logout', session('tenant')['subdomain']) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                @canany(['view_configuration', 'view_permission', 'view_user'])
                    <div x-data="{ open: false }"  class="relative">
                        <div  @click="open = true" class="flex items-center justify-center primary-color primary-text-color h-14 w-14 cursor-pointer
                            {{ request()->is('configuracoes*') ? 'primary-text-active primary-active' : 'primary-text-color' }}"
                              :class="{ 'primary-text-color-active primary-color-active': open }">
                            <span class="material-icons text-3xl ">settings_applications</span>
                        </div>
                        <div x-show="open"
                             x-on:click.stop.outside="open = false"
                             x-transition:enter.duration.500ms
                             x-transition:leave.duration.800ms
                             x-cloak
                             class="absolute items-center z-40 w-72 py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl right-0">
                            @can('tenant_view_configuration')
                                <a href="{{route('layout.index', session('tenant')['subdomain'])}}"
                                   class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                                    <span class="material-icons text-base pr-2">display_settings</span>
                                    Cor e Logo
                                </a>
                            @endcan
                            @if(auth()->user()->tenant->scope == 'Cliente')
                            @can('view_configuration')
                            <a href="{{route('configuration.index', session('tenant')['subdomain'])}}"
                               class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                                <span class="material-icons text-base pr-2">settings_suggest</span>
                               Configurações Sistema
                            </a>
                            @endcan
                            @endif
                            @can('view_permission')
                                <a href="{{route('permissions.index', session('tenant')['subdomain'])}}"
                                   class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                                    <span class="material-icons text-base pr-2">engineering</span>
                                    Permissões
                                </a>
                            @endcan
                            @can('view_user')
                                <a href="{{route('user.index', session('tenant')['subdomain'])}}"
                                   class="block flex items-center px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                                    <span class="material-icons text-base pr-2">people</span>
                                    Usuários
                                </a>
                            @endcan
                                @can('tenant_view_ranking')
                            @if(auth()->user()->tenant->scope == 'Cliente')
                            <a href="{{route('ranking.index', session('tenant')['subdomain'])}}"
                               class="block flex items-center px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                                <span class="material-icons text-base pr-2">star_half</span>
                                Ranking
                            </a>
                            @endif
                            @endcan
                        </div>
                    </div>
                @endcanany

            </div>
        </div>
        <div class="top-200 h-2 {{ session('tenant')['color'] ?? 'bg-gray-500' }}"></div>
    </nav>
</header>

@push('scripts')
    <script>
        Echo.channel('notifications')
            .listen('ProposalAccept', (e) => {
                console.log(e);
            });
    </script>
@endpush
