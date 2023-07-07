<div class="hidden md:flex md:justify-center md:items-center md:mx-auto md:gap-5">
    <a href="{{route('dashboard.index', session('tenant')['subdomain'])}}"
 class="flex items-center gap-1 p-2 h-14 cursor-point
 {{ request()->is('dashboard') ? 'primary-active primary-text-active ' : 'primary-text-color' }}">

    <span class="material-icons text-base self-center mb-0">bar_chart</span>
             Dashboard
    </a>
    @can('tenant_view_charges')
    <a href="{{route('charges.index', session('tenant')['subdomain'])}}"
       class="flex items-center primary-text-color gap-1 p-2 h-14 cursor-point
        {{ Request::routeIs('charges.index')  ? 'primary-active primary-text-active ' : 'primary-text-color' }}">

        <span class="material-icons text-base ">monetization_on</span>
        Cobranças
    </a>
    @endcan

    @can('tenant_view_agreement')
    <a href="{{route('agreement.index', session('tenant')['subdomain'])}}"
       class="flex items-center primary-text-color  gap-1 p-2 h-14 cursor-point
        {{ Request::routeIs('agreement.index')  ? 'primary-active primary-text-active ' : 'primary-text-color' }}">

            <span class="material-icons text-base ">handshake</span>
        Acordos
    </a>
    @endcan
{{--    @can('tenant_view_releases')--}}
{{--    <a href="{{route('releases.index', session('tenant')['subdomain'])}}"--}}
{{--       class="flex items-center  gap-1 p-2 h-14 cursor-point--}}
{{--       {{ Request::routeIs('releases.index')  ? 'bg-white text-sky-800 ' : 'text-white' }}">--}}

{{--        <span class="material-icons text-base self-center mb-0">price_change</span>--}}
{{--        Lançamentos--}}
{{--    </a>--}}
{{--    @endcan--}}
    @can('tenant_view_humor')
        <a href="{{route('humor.index', session('tenant')['subdomain'])}}"
           class="flex items-center primary-text-color  gap-1 p-2 h-14 cursor-point
       {{ Request::routeIs('humor.index')  ? 'primary-active primary-text-active ' : 'primary-text-color' }}">

            <span class="material-icons text-base self-center mb-0">sentiment_very_satisfied</span>
            Humor
        </a>
    @endcan
    @canany(['tenant_view_releases', 'tenant_iew_franchising', 'tenant_view_partner', 'tenant_view_type_status_charges', 'tenant_view_fees'])
<div x-data="{ open: false }" @mouseleave="open = false" class="relative">
    <div  @mouseover="open = true" class="flex items-center primary-text-color  gap-1 p-2 h-14 cursor-pointer
    {{ request()->is('cadastros*') ? 'primary-active primary-text-active ' : 'primary-text-color' }}"
          :class="{ 'primary-text-color-active primary-color-active': open }">
        <span class="material-icons text-base ">post_add</span>
        Cadastros
    </div>
    <div x-show="open"
        x-transition:enter.duration.500ms
        x-transition:leave.duration.800ms
         x-cloak
        class="absolute z-40 w-48 py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl">
        @can('tenant_view_releases')
        <a href="{{route('releases.index', session('tenant')['subdomain'])}}"

           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
            Lançamentos
        </a>
        @endcan
        @can('tenant_view_franchising')
        <a href="{{route('franchising.index', session('tenant')['subdomain'])}}"

           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
            Franqueados
        </a>
        @endcan
        @can('tenant_view_partner')
        <a href="{{route('partners.index', session('tenant')['subdomain'])}}"
            class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
            Socios
        </a>
        @endcan

        @can('tenant_view_type_status_charges')
        <a href="{{route('chargestatuses.index', session('tenant')['subdomain'])}}"
           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
            Status da Cobrança
        </a>
        @endcan
        @can('tenant_view_fees')
        <a href="{{route('fees.index', session('tenant')['subdomain'])}}"
           class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20
           ">
            Juros de Cobrança
        </a>
        @endcan
    </div>
</div>
    @endcanany
    @canany(['tenant_view_report_charges', 'tenant_view_report_releases', 'tenant_view_report_agreements'])
        <div x-data="{ open: false }" @mouseleave="open = false" class="relative">
            <div  @mouseover="open = true" class="flex items-center primary-text-color  gap-1 p-2 h-14 cursor-pointer
    {{ request()->is('relatorios*') ? 'primary-active primary-text-active ' : 'primary-text-color' }}"
                  :class="{ 'primary-text-color-active primary-color-active': open }">
                <span class="material-icons text-base ">pending_actions</span>
                Relatorios
            </div>
        <div x-show="open"
             x-transition:enter.duration.500ms
             x-transition:leave.duration.800ms
             x-cloak
             class="absolute z-40 w-48 py-2 rounded-br-lg rounded-bl-lg bg-white shadow-xl">
            @can('tenant_view_report_charges')
            <a href="{{route('report.charges.index', session('tenant')['subdomain'])}}"

               class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                Histórico Cobrança
            </a>
            @endcan
            @can('tenant_view_report_releases')
            <a href="{{route('report.releases.index', session('tenant')['subdomain'])}}"
               class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                Lançamentos
            </a>
            @endcan
            @can('tenant_view_report_agreements')
            <a href="{{route('report.agreements.index', session('tenant')['subdomain'])}}"
               class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                Acordos
            </a>
            @endcan
            @can('tenant_view_report_agreements')
            <a href="{{route('report.humor.index', session('tenant')['subdomain'])}}"
               class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                Humor
            </a>
            @endcan
        </div>
    </div>
    @endcanany
</div>




