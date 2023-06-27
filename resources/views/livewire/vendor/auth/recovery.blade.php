<div>
    @if(!$sent)
    <div class="flex flex-col items-start justify-start p-5">
        <h4 class="mb-5">Recuperar Senha !</h4>
        <p>Por favo, insira seu email cadastrado para enviar as instruções de como resetar sua senha.</p>
    </div>
    @endif

    @include('includes.alerts')

    @if(!$sent)

    <form wire:submit.prevent="submit">
        <div class="md:grid grid-cols-1 gap-4 p-5">
            <div class="md:col-span-1">
                <x-input right-icon="mail" type="email" label="Email" wire:model.defer="state.email"  placeholder="Seu Email" />
                @error('email') <span class="text-red-600"> {{ $message }} </span>@enderror
            </div>
            <div class="flex justify-items-center py-2">
                <x-button type="submit" sky label="Enviar Email" />
            </div>
         </div>
    </form>
    @else
        <div class="flex flex-col items-center justify-center gap-5 p-5">
            <h4 class="mb-2">Email Enviado com succeso !</h4>
            <p>Senha Enviada com sucesso, por favor veja seu email as instruções para cadastrar uma nova senha</p>
            <x-button a href="{{route('login')}}" label="Login" info />
        </div>
    @endif



</div>
