<div>
    <div x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'proposals' }" id="tab_wrapper"
         class="grid grid-cols-3 gap-5">
        <button :class="{ 'bg-sky-700 text-white': tab === 'proposals' }" @click.prevent="tab = 'proposals'; window.location.hash = 'proposals'"
                class="text-white p-4 rounded text-sky-800 shadow-md flex items-center justify-center"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                />
            </svg>
            Propostas
        </button>
        <button :class="{ 'bg-sky-800 text-white': tab === 'charges' }" @click.prevent="tab = 'charges'; window.location.hash = 'charges'"
                class="p-4 rounded bg-white text-sky-800 shadow-md flex items-center justify-center"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
            Cobranças
        </button>
        <button :class="{ 'bg-sky-800 text-white': tab === 'agreements' }" @click.prevent="tab = 'agreements'; window.location.hash = 'agreements'"
                class="p-4 rounded bg-white text-sky-800 shadow-md flex items-center justify-center"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 mr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"
                />
            </svg>
            Acordos
        </button>

        <div class="col-span-3">
            <div x-show="tab === 'proposals'"
                 class="shadow-xl border border-gray-100 font-light p-8 rounded text-gray-500 bg-white ">
                @livewire('dashboard.chart.proposals.graph')
            </div>

            <div x-show="tab === 'charges'"
                 class="shadow-xl border border-gray-100 font-light p-8 rounded text-gray-500 bg-white">
                @livewire('dashboard.chart.charges.graph')
            </div>

            <div x-show="tab === 'agreements'"
                 class="shadow-xl border border-gray-100 font-light p-8 rounded text-gray-500 bg-white">
                @livewire('dashboard.chart.agreements.graph')
            </div>
        </div>

    </div>

</div>

{{--<div class="col-span-12 justify-center ">--}}
{{--    <x-card cardClasses="min-h-24">--}}
{{--        <div class="items-start border-b-2 mb-2 justify-between">--}}
{{--            <h1 class="text-base text-gray-600 font-semibold ">Propostas Geradas por Equipe</h1>--}}
{{--        </div>--}}
{{--        <div class="flex justify-center items-center">--}}
{{--            <div class="ml-4" id="chart"> </div>--}}
{{--        </div>--}}
{{--    </x-card>--}}
{{--</div>--}}


