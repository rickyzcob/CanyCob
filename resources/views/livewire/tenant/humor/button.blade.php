<div>
    <div x-data="{ isOpen: false }"  class="fixed z-40 left-0 flex items-center justify-start h-screen">
        <div
            @click="isOpen = true" class="primary-color primary-text-color shadow-xl flex items-center justify-left p-3 z-40 rounded-r-lg absolute"
            :class="isOpen ? 'transition duration-300 ease-in-out transform sm:duration-500 translate-x-[600px]' : 'transition duration-300 ease-in-out transform sm:duration-500'"
        >
            <button  class="hover:font-semibold ">
                <span class="material-icons text-4xl ">add_reaction</span>
            </button>
        </div>
        <div
            class="fixed top-16 z-10 md:w-[600px] w-full bg-neutral-50 text-gray-500 border-r-8 h-screen overscroll-contain overflow-y-auto p-4 pb-20 drop-shadow-md "
            x-show="isOpen"
            x-cloak

            x-on:click.stop.outside="isOpen = false"
            x-transition:enter="transition duration-300 ease-in-out transform sm:duration-500"
            x-transition:enter-start="-translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition duration-300 ease-in-out transform sm:duration-500"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="-translate-x-full opacity-0"
        >

            <div class="flex justify-between pt-8">
{{--                <span class="font-bold text-2xl sm:text-3xl">Sidebar</span>--}}
                <button class="p-2 rounded hover:bg-sky-700 hover:text-white" @click="isOpen = false">
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
            <div class="p-2">
                @livewire('tenant.dashboard.humor.card')
            </div>
        </div>
    </div>
</div>
