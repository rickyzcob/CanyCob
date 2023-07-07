@extends ('layouts.guest')
@section('title', 'Recuperar Senha')

@section('content')
<div class="w-full h-screen text-gray-500 md:flex bg-cover" >
    <div class="flex items-center justify-center gap-5 bg-white py-5 md:w-1/2 bg-cover" >
        <img src="https://png.pngtree.com/png-vector/20220730/ourmid/pngtree-m-company-logo-png-image_6092974.png" alt="" />
    </div>
    <div class="flex flex-col items-center justify-center primary-color py-5 md:w-1/2">
        <div class="flex items-center p-2">
            @if(session('tenant')['logo'] == null)
                <span class="self-center text-xl font-semibold whitespace-nowrap uppercase primary-text-color">{{ session('tenant')['name'] }}</span>
            @else
                <img src="{{ asset('storage/'.session('tenant')['logo']) }}" class="h-6 mr-3 sm:h-10"  alt="{{ auth()->user()->tenant->name }}" >
            @endif
        </div>
        <div class="w-2/3 gap-3 rounded-md bg-white p-3 shadow-md">
            @livewire('vendor.auth.login')
        </div>
    </div>
</div>
@stop
