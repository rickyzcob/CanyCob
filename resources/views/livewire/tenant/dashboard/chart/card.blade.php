<div>
    @if(auth()->user()->type == 'Colaborador')
    <div x-data="{ tab : 'chargesPhone' }" id="tab_wrapper"
         class="grid grid-cols-3 text-gray-500 gap-5">
        <button :class="{ 'primary-color primary-text-color': tab === 'chargesPhone' }" @click.prevent="tab = 'chargesPhone'"
                class="p-2 rounded  shadow-md flex items-center justify-center"
        >
            <div class="mr-2">
                <span class="material-icons text-lg ">add_ic_call</span>
            </div>
            Telefones
        </button>
        <button :class="{ 'primary-color primary-text-color': tab === 'chargesEmail' }" @click.prevent="tab = 'chargesEmail'"
                class="p-2 rounded  shadow-md flex items-center justify-center"
        >
            <div class=" mr-2">
                <span class="material-icons text-lg ">forward_to_inbox</span>
            </div>
            Emails
        </button>
        <button :class="{ 'primary-color primary-text-color': tab === 'chargesWhatsapp' }" @click.prevent="tab = 'chargesWhatsapp'"
                class="p-2 rounded shadow-md  flex items-center justify-center"
        >
            <div class="h-6 w-6 mr-2">
                <i class="fa fa-whatsapp text-base"></i>
            </div>

            Whatsapp
        </button>

        <div class="col-span-3 h-64">
            <div x-show="tab === 'chargesPhone'">
                @livewire('tenant.dashboard.graphs.phone')
            </div>

            <div x-show="tab === 'chargesEmail'">
                @livewire('tenant.dashboard.graphs.email')
            </div>

            <div x-show="tab === 'chargesWhatsapp'">
                @livewire('tenant.dashboard.graphs.whatsapp')
            </div>
        </div>
    </div>
    @elseif(auth()->user()->type == 'Gestão')
        @livewire('tenant.dashboard.graphs.users')
        @endif
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


