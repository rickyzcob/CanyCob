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
{{--        <div class="p-2">--}}
{{--            @livewire('vendor.dashboard.warnings.card')--}}
{{--        </div>--}}

        <div class="grid grid-cols-1 md:grid-cols-12 w-full gap-3 relative gap-5 px-5">
            <div class="md:col-span-2">
                @livewire('tenant.schedule.filter')
            </div>
            <div class="md:col-span-10">
                @livewire('tenant.schedule.card')
            </div>
        </div>
    </div>
