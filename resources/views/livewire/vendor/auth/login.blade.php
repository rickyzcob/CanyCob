<div>
    <div class="flex flex-col items-center justify-center">
        <h4 class="mb-5">Bem vindo de volta !</h4>
        <p >Faça seu login para acessar o sistema</p>
    </div>

    <form wire:submit.prevent="submit">
        <div class="md:grid grid-cols-1 gap-4 p-5">
            <div class="md:col-span-1">
                <x-input right-icon="user" type="email" label="Email" wire:model.defer="state.email"  placeholder="Seu Email" />
                @error('email') <span class="text-red-600"> {{ $message }} </span>@enderror
            </div>

            <div class="md:col-span-1">
                <x-inputs.password icon="user" type="password" label="Senha" wire:model.defer="state.password" />
                @error('password') <span class="text-red-600"> {{ $message }} </span>@enderror
                {{--                    <x-inputs.password label="Secret 🙈"  placeholder="Senha"/>--}}
            </div>

            <div class="md:col-span-1">
            @include('includes.alerts')
            </div>

            @if($error)
                <div class="md:col-span-1">
                    <div
                        class="bg-red-50 border border-red-400 rounded text-red-800 text-sm p-4 flex justify-between"
                    >
                        <div>
                            <div class="flex items-center">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 mr-2"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <p>
{{--                                        <span class="font-bold">Erro:</span>--}}
                                    {{ $error }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{--                <div class="form-group row m-t-20">--}}
            {{--                    <div class="col-6">--}}
            {{--                        <x-checkbox id="right-label" label="Manter Conectado" wire:model.defer="model" />--}}
            {{--                    </div>--}}
            {{--                </div>--}}

            <div class="flex justify-items-center py-2">
                <x-button type="submit" sky label="Acessar" />
            </div>
{{--@dd(session('tenant')['subdomain'])--}}
            <div class="py-2">
                <a href="{{route('password.request', session('tenant')['subdomain'])}}" class="text-muted"><i class="mdi mdi-lock"></i> Esqueceu a senha ?</a>
            </div>
        </div>



    </form>
</div>
</div>

