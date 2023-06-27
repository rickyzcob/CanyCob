<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="p-4">
            <ol class="list-reset flex gap-2">
                <span class="material-icons text-base ">sentiment_very_satisfied</span>
                <li class="text-gray-100">Humor</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold py-2">Humor dos Colaboradores</h1>
            </div>
            @livewire('tenant.humor.filter')
            <div class="justify-center items-center mb-2">
                <p> Confira o feedback dos colaboradores ! </p>
            </div>
            @livewire('tenant.humor.card')
        </div>
    </div>

