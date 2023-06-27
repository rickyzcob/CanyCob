@extends ('layouts.app')
@section('title', 'Acordos | Vizualizar')

@section('content')
    <div class="page-title-box">
        <div class="container xl justify-center items-center min-h-[640px]">
            <nav class="p-5">
                <ol class="list-reset flex">
                    <li><a href="{{route('agreement.index')}}" class="text-whites hover:text-blue-700">Acordos</a></li>
                    <li><span class="text-white mx-2"> / </span></li>
                    <li class="text-gray-100">Vizualizar</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 md:grid-cols-12 justify-center items-start gap-5">
                <div class="md:col-span-12">
                    @livewire('admin.tenant.show.card', ['reference' => $reference])
                </div>
            </div>
        </div>

@stop
