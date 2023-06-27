@extends ('layouts.guest')
@section('title', 'Recuperar Senha')

@section('content')

<div class="w-full h-screen text-gray-500 md:flex">
    <div class="flex items-center justify-center gap-5 bg-white py-5 md:w-1/2 bg-cover" style="background-image: url('img/bg_login.png')" >
        <img src="https://png.pngtree.com/png-vector/20220730/ourmid/pngtree-m-company-logo-png-image_6092974.png" alt="" />
    </div>
    <div class="flex flex-col items-center justify-center bg-color py-5 md:w-1/2">
        <div >
            <img src="https://png.pngtree.com/png-vector/20220730/ourmid/pngtree-m-company-logo-png-image_6092974.png" width="100px" height="100px" alt="">
        </div>
        <div class="w-2/3 gap-3 rounded-md bg-white p-3 shadow-md">
            @livewire('vendor.auth.login')
        </div>
    </div>
</div>
@stop
