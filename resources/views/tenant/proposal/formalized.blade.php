<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Formalização de proposta</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>


{{--    @vite('resources/css/app.css')--}}



</head>
<body class="bg-gray-100 justify-center">

<div class="container md px-40 py-10 ">
    <x-card>
        <div class="flex flex-col justify-center gap-4 text-gray-500 p-5">
            @if(session('tenant')['logo'] =! null)

            <div class="w-36 ">
                <img src="https://blog.odontocompany.com/wp-content/uploads/2020/07/Logo-974x310px-1.png">
            </div>
            @else
            <div>
                {{ session('tenant')['name'] }}
            </div>
            @endif
            <div class="text-center border-b">
                PROPOSTA {{ $proposal['reference']  }}
            </div>

            @if($proposal['status'] == 'Ativo')
                {!! $proposal['content'] !!}
            @else
                <div class="flex flex-col w-full xl:w-4/5 justify-center lg:items-start overflow-y-hidden">
                    <h1 class="my-4 text-3xl md:text-4xl text-green-800 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">Proposta Expirada !</h1>
                    <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">Desculpe, sua proposta de quitação expirou o prazo de validade, aguarde para mais novidades!</p>
                </div>
            @endif

            <div class="text-center">
                @livewire('tenant.proposal-accept.button-accept', ['id' => $proposal['id']] )
            </div>


        </div>
    </x-card>

</div>


{{--<div class="container xl justify-center items-center min-h-[640px]">--}}
{{--<header class="clearfix">--}}
{{--    <div id="logo">--}}
{{--        <img src="https://blog.odontocompany.com/wp-content/uploads/2020/07/Logo-974x310px-1.png">--}}
{{--    </div>--}}
{{--    @if($proposal['status'] == 'Ativo')--}}
{{--        {!! $proposal['content'] !!}--}}
{{--    @else--}}
{{--        <div class="flex flex-col w-full xl:w-4/5 justify-center lg:items-start overflow-y-hidden">--}}
{{--            <h1 class="my-4 text-3xl md:text-4xl text-green-800 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">Proposta Expirada !</h1>--}}
{{--            <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">Desculpe, sua proposta de quitação expirou o prazo de validade, aguarde para mais novidades!</p>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @livewire('tenant.porposal.accept')--}}

{{--    @if($proposal['accept'] == 'Sim' && $proposal['status'] == 'Ativo')--}}
{{--        <div id="accept">--}}
{{--            Proposta Aceita em {{ formatDateAndTime($proposal['updated_at']) }}--}}
{{--        </div>--}}
{{--    @elseif ($proposal['accept'] == 'Não' && $proposal['status'] == 'Ativo')--}}
{{--    <div id="accept">--}}
{{--        <x-button class="button button1" x-data={}--}}
{{--                x-on:click="livewire.emitTo('components.central-modal', 'showCentralModal', 'tenant.porposal.form', 'Confirmar CPF', 'Para aceitar a proposta acima voce deve inserir seu CPF abaixo', {'id': {{$proposal['id']}} }, 'confirmSubmitCPF')">Aceitar Proposta </x-button>--}}
{{--        </div>--}}
{{--    <div id="accept">--}}
{{--        <x-button class="button button1" x-data={}--}}
{{--                x-on:click="livewire.emitTo('notifications.read', 'markAsRead', 'b7eec89c-eee5-4cbb-8a07-1f0090e81e51', '56')" >teste </x-button>--}}
{{--    </div>--}}
{{--        @endif--}}

</header>


<x-notifications/>
<x-dialog z-index="z-50" blur="md" align="center" />

@livewire('vendor.notifications.read')
@livewire('vendor.notifications.button', ['visible' => false])
@livewire('components.open-modal')
@livewire('components.open-modal2')
@livewire('components.open-modal3')
@livewire('components.confirm-modal')
@livewire('components.central-modal')

    @livewireStyles
    @wireUiScripts
@livewireScripts

</body>
</html>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
