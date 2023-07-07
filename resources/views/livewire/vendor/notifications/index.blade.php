<div class="page-title-box">
    <div class="container xl justify-center items-center min-h-[640px]">
        <nav class="p-4">
            <ol class="list-reset flex gap-2">
                <span class="material-icons text-base ">notifications</span>
                <li><a href="#" class="text-whites hover:text-blue-700">Notificações</a></li>
                <li><span class="text-white mx-2"> / </span></li>
                <li class="text-gray-100">Minhas Notificações</li>
            </ol>
        </nav>
        <div class="card p-5 gap-4 p-2">
            <div class="flex items-start justify-between  border-b-2 mb-2 ">
                <h1 class="text-lg text-gray-600 font-semibold py-2">Notificações</h1>
            </div>

            @livewire('vendor.notifications.filter')

            <div class="justify-center items-center mb-2">
                <p> Lista de Notificações </p>
            </div>

            @livewire('vendor.notifications.table')
        </div>
    </div>


