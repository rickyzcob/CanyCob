<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="py-5">
            <ol class="list-reset flex">
                <li><a href="#" class="text-whites hover:text-blue-700">Notificações</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">Minhas Notificações</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold py-2">Notificações</h1>
            </div>

            @livewire('notifications.filter')

            <div class="justify-center items-center mb-2">
                <p> Lista dos Jurs Cadastrados </p>
            </div>

            @livewire('notifications.table')
        </div>
    </div>


