<div class="hidden md:flex md:justify-center md:items-center md:mx-auto md:gap-5">
    <a href="{{route('dashboard.index')}}"
 class="flex items-center hover:bg-white hover:text-sky-700 gap-1 p-2 h-14 cursor-point
 {{ request()->is('dashboard') ? 'bg-white text-sky-800 ' : 'text-white' }}">

    <span class="material-icons text-base self-center mb-0">bar_chart</span>
             Dashboard
    </a>
    @can('view_charges')
    <a href="{{route('charges.index')}}"
       class="flex items-center hover:bg-white text-sky-700 hover:text-sky-700 gap-1 p-2 h-14 cursor-point
        {{ Request::routeIs('charges.index')  ? 'bg-white text-sky-800 ' : 'text-white' }}">

        <span class="material-icons text-base ">monetization_on</span>
        Cobranças
    </a>
    @endcan

    @can('view_agreement')
    <a href="{{route('agreement.index')}}"
       class="flex items-center hover:bg-white hover:text-sky-700 gap-1 p-2 h-14 cursor-point
        {{ Request::routeIs('agreement.index')  ? 'bg-white text-sky-800 ' : 'text-white' }}">

            <span class="material-icons text-base ">handshake</span>
        Acordos
    </a>
    @endcan
    @can('view_releases')
    <a href="{{route('releases.index')}}"
       class="flex items-center hover:bg-white hover:text-sky-700 gap-1 p-2 h-14 cursor-point
       {{ Request::routeIs('releases.index')  ? 'bg-white text-sky-800 ' : 'text-white' }}">

        <span class="material-icons text-base self-center mb-0">price_change</span>
        Lançamentos
    </a>
    @endcan

    @canany(['view_franchising', 'view_partner', 'view_status_franchising', 'view_type_sales', 'view_type_termination','view_type_status_charges','view_fees'])
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
        @can('view_franchising')
        <a href="{{route('franchising.index')}}"

           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
            Franqueados
        </a>
        @endcan
        @can('view_partner')
        <a href="{{route('partners.index')}}"
            class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
            Socios
        </a>
        @endcan
        @can('view_status_franchising')
        <a href=""
           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
            Status do Franqueado
        </a>
        @endcan
        @can('view_type_sales')
        <a href="#"
            class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
            Tipo de Vendas
        </a>
        @endcan
        @can('view_type_termination')
        <a href="#"
           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
            Tipos de Recisão
        </a>
        @endcan
        @can('view_type_status_charges')
        <a href="{{route('chargestatuses.index')}}"
           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
            Status da Cobrança
        </a>
        @endcan
        @can('view_fees')
        <a href="{{route('fees.index')}}"
           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20
           ">
            Juros de Cobrança
        </a>
        @endcan
    </div>
</div>
    @endcanany
    @canany(['view_report_charges', 'view_report_releases', 'view_report_agreements'])
    <div x-data="{ open: false }" @mouseleave="open = false" class="relative cursor-pointer">
        <div @mouseover="open = true" class="flex items-center text-white hover:bg-white hover:text-sky-700 gap-1 p-2 h-14 cursor-point">
            <span class="material-icons text-base ">text_snippet</span>

            Relatórios
        </div>
        <div x-show="open"
             x-transition:enter.duration.500ms
             x-transition:leave.duration.800ms
             x-cloak
             class="absolute z-40 w-48 py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl">
            @can('view_report_charges')
            <a href="{{route('report.charges.index')}}"

               class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                Histórico Cobrança
            </a>
            @endcan
            @can('view_report_releases')
            <a href="{{route('report.releases.index')}}"
               class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                Lançamentos
            </a>
            @endcan
            @can('view_report_agreements')
            <a href="{{route('report.agreements.index')}}"
               class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                Acordos
            </a>
            @endcan
        </div>
    </div>
    @endcanany
</div>




