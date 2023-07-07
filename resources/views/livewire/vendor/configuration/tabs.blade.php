<div>
    <x-card cardClasses="border-l-4 border-teste">
        <div x-data="{ openTab: '1' }" id="tab_wrapper_charges"
             class="grid grid-cols-2 text-gray-500  gap-1">

            <button :class="{ 'border-teste primary-text-color-active': openTab === '1' }" @click.prevent="openTab = '1'"
                    class="px-2 flex items-center justify-center"
            >
                <div class="mr-2">
                    <span class="material-icons text-lg ">monetization_on</span>
                </div>
                Dados Cadastrais
            </button>
            <button :class="{ 'border-teste primary-text-color-active': openTab === '2' }" @click.prevent="openTab = '2'"
                    class="px-2 flex items-center justify-center"
            >
                <div class="mr-2">
                    <span class="material-icons text-lg ">monetization_on</span>
                </div>
                Tokens ClickSign
            </button>

            <div class="col-span-2">
                <div x-show="openTab === '1'">
                    @livewire('vendor.configuration.data')
                </div>

                <div x-show="openTab === '2'">
                    @livewire('vendor.configuration.click-sign')
                </div>
            </div>
        </div>
    </x-card>
</div>
