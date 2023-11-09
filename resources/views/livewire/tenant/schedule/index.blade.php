<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]" x-data="{ open: true }">
        <nav class="p-4">
            <ol class="list-reset flex gap-2">
                <span class="material-icons text-base ">calendar_month</span>
                <li><a href="#" class="text-whites hover:text-blue-700">Cobranças</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">Agenda</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold py-2">Minha Agenda</h1>
{{--                @if(!$error)--}}
{{--                    <x-button icon="plus-circle" positive label="Fazer Pedido" x-data={}--}}
{{--                              x-on:click="livewire.emitTo('components.open-modal', 'showModal', 'vendor.order.form', {'id' : null})" >--}}
{{--                    </x-button>--}}
{{--                @endif--}}
            </div>
            @livewire('tenant.schedule.search')
        </div>
        <div class="p-2">
{{--            @livewire('vendor.dashboard.warnings.card')--}}
        </div>

        <div class="flex px-2 gap-2">
            <div x-cloak  x-show="open"
                 {{--                 x-transition.scale.origin.left--}}
                 x-transition:enter="transition ease-out  duration-300"
                 x-transition:enter-start="opacity-0 -translate-x-10 scale-45"
                 x-transition:enter-end="opacity-100 translate-x-0 scale-180"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-45"
            >
                @livewire('tenant.schedule.filter')
            </div>
            <div class="w-full">
                @livewire('tenant.schedule.card')
            </div>
        </div>
    </div>
