<div>
    <div x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'chargesPhone' }" id="tab_wrapper"
         class="grid grid-cols-3 gap-5">
        <button :class="{ 'bg-sky-700 text-white': tab === 'chargesPhone' }" @click.prevent="tab = 'chargesPhone'; window.location.hash = 'chargesPhone'"
                class="text-white p-4 rounded text-sky-800 shadow-md flex items-center justify-center"
        >
            <div class="mr-2">
                <span class="material-icons text-lg ">add_ic_call</span>
            </div>
            Telefones
        </button>
        <button :class="{ 'bg-sky-700 text-white': tab === 'chargesEmail' }" @click.prevent="tab = 'chargesEmail'; window.location.hash = 'chargesEmail'"
                class="p-4 rounded text-sky-800 shadow-md flex items-center justify-center"
        >
            <div class=" mr-2">
                <span class="material-icons text-lg ">forward_to_inbox</span>
            </div>
            Emails
        </button>
        <button :class="{ 'bg-sky-700 text-white': tab === 'chargesWhatsapp' }" @click.prevent="tab = 'chargesWhatsapp'; window.location.hash = 'chargesWhatsapp'"
                class="p-4 rounded text-sky-800 shadow-md flex items-center justify-center"
        >
            <div class="h-6 w-6 mr-2">
                <i class="fa fa-whatsapp text-base"></i>
            </div>

            Whatsapp
        </button>

        <div class="col-span-3">
            <div x-show="tab === 'chargesPhone'"
                 class="shadow-xl border border-gray-100 font-light p-8 rounded text-gray-500 bg-white ">
                @livewire('tenant.dashboard.graphs.phone')
            </div>

            <div x-show="tab === 'chargesEmail'"
                 class="shadow-xl border border-gray-100 font-light p-8 rounded text-gray-500 bg-white">
                @livewire('tenant.dashboard.graphs.email')
            </div>

            <div x-show="tab === 'chargesWhatsapp'"
                 class="shadow-xl border border-gray-100 font-light p-8 rounded text-gray-500 bg-white">
                @livewire('tenant.dashboard.graphs.whatsapp')
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


