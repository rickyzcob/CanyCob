<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="p-4">
            <ol class="list-reset flex gap-2">
                <span class="material-icons text-base ">monetization_on</span>
                <li class="text-gray-100">Cobranças</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 p-2">


            @livewire('charges.filter')

            <div class="justify-center items-center mb-2">
                <p> Lista de Franqueados Em dividas</p>
            </div>

            <div class="flex gap-2">


{{--                <div>--}}
{{--                    @livewire('charges.sidebar')--}}
{{--                </div>--}}

                <div class="w-full">
                    @livewire('charges.table')
                </div>

            </div>

        </div>
    </div>

