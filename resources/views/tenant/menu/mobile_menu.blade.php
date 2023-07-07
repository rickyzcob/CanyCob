<div class="fixed top-16 md:w-auto md:h-auto md:bg-opacity-0 z-40 text-gray-500 w-full h-screen overflow-y-auto bg-white p-4"
    x-show="isMobileOpen"
    x-cloak
    x-on:click.stop.outside="isMobileOpen = false"
    x-transition:enter="transition ease-linear duration-200 transform"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-out duration-200 transform"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full">

    <div class="flex justify-between pt-8">
        <span class="font-bold text-2xl sm:text-3xl">Menu</span>
        <button class="p-2 primary-color primary-text-color rounded hover:bg-sky-700 hover:text-white" @click="isMobileOpen = false">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                />
            </svg>
        </button>
    </div>
    <div>
        <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200 gap-4">
            <a href="{{route('dashboard.index', session('tenant')['subdomain'])}}"  class="flex items-center bg-white ">
                <span class="material-icons text-base self-center mb-0">bar_chart</span>
                <p class="pl-1 py-2">Dashboard</p>
            </a>
        </div>
        @can('tenant_view_charges')
        <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200 gap-4">
            <a href="{{route('charges.index', session('tenant')['subdomain'])}}"  class="flex items-center bg-white ">
                <span class="material-icons text-base ">monetization_on</span>
                <p class="pl-1 py-2">Cobranças</p>
            </a>
        </div>
        @endcan
        @can('tenant_view_agreement')
        <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200 gap-4">
            <a href="{{route('agreement.index', session('tenant')['subdomain'])}}"  class="flex items-center bg-white ">
                <span class="material-icons text-base ">handshake</span>
                <p class="pl-1 py-2">Acordos</p>
            </a>
        </div>
        @endcan
        @can('tenant_view_humor')
        <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200">
            <a href="{{route('humor.index', session('tenant')['subdomain'])}}"  class="flex items-center bg-white ">
                <span class="material-icons text-base self-center mb-0">sentiment_very_satisfied</span>
                <p class="pl-1 py-2">Humor</p>
            </a>
        </div>
        @endcan
        @canany(['tenant_view_releases', 'tenant_iew_franchising', 'tenant_view_partner', 'tenant_view_type_status_charges', 'tenant_view_fees'])

        <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200 gap-4">
            <div @click="open=!open"  class="flex items-center bg-white ">
                <span class="material-icons text-base ">post_add</span>
                <p class="pl-1 py-2">Cadastros</p>
            </div>
            <div x-show="open" x-cloak  class="flex flex-col mx-4" x-transition>
                @can('tenant_view_releases')
                    <a href="{{route('releases.index', session('tenant')['subdomain'])}}"

                       class="block py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                        Lançamentos
                    </a>
                @endcan
                @can('tenant_view_franchising')
                    <a href="{{route('franchising.index', session('tenant')['subdomain'])}}"

                       class="block py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-200">
                        Franqueados
                    </a>
                @endcan
                @can('tenant_view_partner')
                    <a href="{{route('partners.index', session('tenant')['subdomain'])}}"
                       class="block py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                        Socios
                    </a>
                @endcan

                @can('tenant_view_type_status_charges')
                    <a href="{{route('chargestatuses.index', session('tenant')['subdomain'])}}"
                       class="block  py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600  border-b-2 border-gray-20">
                        Status da Cobrança
                    </a>
                @endcan
                @can('tenant_view_fees')
                    <a href="{{route('fees.index', session('tenant')['subdomain'])}}"
                       class="block py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600">
                        Juros de Cobrança
                    </a>
                @endcan
            </div>
        </div>
        @endcanany
        @canany(['tenant_view_report_charges', 'tenant_view_report_releases', 'tenant_view_report_agreements'])
        <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200">
            <div @click="open=!open"  class="flex items-center bg-white">
                <span class="material-icons text-base ">pending_actions</span>
                <p class="pl-1  py-2">Relatórios</p>
            </div>
            <div x-show="open" x-cloak  class="flex flex-col mx-4" x-transition>
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
                       class="block px-4 py-2 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-600">
                        Humor
                    </a>
                @endcan

            </div>
        </div>
        @endcanany
    </div>
</div>
