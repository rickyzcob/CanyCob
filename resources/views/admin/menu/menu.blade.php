<div class="hidden md:flex md:justify-center md:items-center md:mx-auto md:gap-5">
    <a href="{{route('admin.dashboard.index')}}"
 class="flex items-center hover:bg-white hover:text-sky-700 gap-1 p-2 h-14 cursor-point
 {{ request()->is('dashboard') ? 'bg-white text-sky-800 ' : 'text-white' }}">

    <span class="material-icons text-base self-center mb-0">bar_chart</span>
             Dashboard
    </a>

{{--    @can('view_releases')--}}
    <a href="{{route('tenant.index')}}"
       class="flex items-center hover:bg-white hover:text-sky-700 gap-1 p-2 h-14 cursor-point
       {{ Request::routeIs('clients.index')  ? 'bg-white text-sky-800 ' : 'text-white' }}">

        <span class="material-icons text-base self-center mb-0">price_change</span>
        Clientes
    </a>
{{--    --}}
    <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
        <div  @mouseover="open = true" class="flex items-center hover:bg-white hover:text-sky-700 gap-1 p-2 h-14 cursor-pointer
    {{ request()->is('cadastros*') ? 'text-sky-800 bg-white' : 'text-white' }}">
            <span class="material-icons text-base ">post_add</span>
            Cadastros
        </div>
        <div x-show="open"
             x-transition:enter.duration.500ms
             x-transition:leave.duration.800ms
             x-cloak
             class="absolute z-40 w-48 py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl">





                <a href="#"
                   class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                    Tipo de Vendas
                </a>


        </div>
    </div>
</div>




