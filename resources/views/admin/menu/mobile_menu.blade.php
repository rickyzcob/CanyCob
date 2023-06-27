<div class="absolute md:w-auto md:h-auto md:bg-opacity-0   z-10 text-gray-500 w-full h-full overflow-y-auto bg-white p-4"
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
        <span class="font-bold text-2xl sm:text-3xl">Sidebar</span>
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
    <div>
        <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200 gap-4">
            <div @click="open=!open"  class="flex justify-between items-center bg-white ">
                <p class="py-2">Accordion 1</p>
            </div>
            <div x-show="open" x-cloak  class="mx-4 py-2" x-transition>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dicta repudiandae ut dolores totam nobis molestias!</div>

        </div>
        <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200">
            <div @click="open=!open"  class="flex justify-between items-center bg-white">
                <p class="py-2">Accordion 2</p>
            </div>
            <div x-show="open" x-cloak class="mx-4 py-2" x-transition>

            </div>

        </div>
        <div x-data="{open:false}" class="mx-auto bg-white border-b-2 border-gray-200">
            <div @click="open=!open"  class="flex justify-between items-center bg-white">
                <p class="py-2">Menu 3</p>
            </div>
            <div x-show="open" x-cloak class="mx-4 py-2" x-transition>

            </div>
        </div>
    </div>
</div>
