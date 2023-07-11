<div>
    <x-card cardClasses="h-[462px] border-l-4 border-red-600">
    <div x-data="{ tab_charge: 'charges' }" id="tab_wrapper_charges"
         class="grid grid-cols-4 text-gray-500 border-b-2 mb-2 gap-1">
        <button :class="{ 'border-teste': tab_charge === 'charges' }" @click.prevent="tab_charge = 'charges'"
                class="p-2 flex items-center justify-center"
        >
            <div class="mr-2">
                <span class="material-icons text-lg ">monetization_on</span>
            </div>
            Em Cobrança
        </button>
        <button :class="{ 'border-teste': tab_charge === 'conference' }" @click.prevent="tab_charge = 'conference'"
                class="p-2 flex items-center justify-center"
        >
            <div class=" mr-2">
                <span class="material-icons text-lg ">monetization_on</span>
            </div>
            Aguardando Pagamento
        </button>

        <div class="col-span-4">
            <div x-show="tab_charge === 'charges'">
                @livewire('tenant.dashboard.charges.card')
            </div>

            <div x-show="tab_charge === 'conference'">
                @livewire('tenant.dashboard.charges.conference')
            </div>
        </div>
    </div>
    </x-card>
</div>


