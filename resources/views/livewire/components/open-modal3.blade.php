<div>
    <div class="fixed top-16 top-0 right-0 z-30 md:w-[680px] w-full bg-neutral-50 text-gray-500 h-screen overscroll-contain overflow-y-auto p-4  drop-shadow-md"
         x-data="{show: @entangle('showModal3')}"
         x-show="show"
         x-cloak
         x-on:click.stop.outside="show = false"
         x-transition:enter="transition ease-linear duration-200 transform"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="-translate-x-0"
         x-transition:leave="transition ease-out duration-200 transform"
         x-transition:leave-start="-translate-x-0"
         x-transition:leave-end="translate-x-full"
    >
        <div class="flex justify-end pt-2">
            <x-button.circle dark icon="x-circle" wire:click="closeModals(3)" />
        </div>
        @if($showModal3)
            <div class="p-2">
                @livewire($component, $params)
            </div>
        @endif
    </div>
</div>


