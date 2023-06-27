<div>
    <x-card>
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-12 gap-4 p-5">
                <div class="md:col-span-12"><div class="flex flex-between border-b-2 mb-2 ">Dados do Integrador</div>
                </div>
                <div class="col-span-6">
                    <x-input icon="user" wire:model.defer="state.name" label="Nome da Empresa" placeholder="Nome" />
                    @error('name')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-span-6">
                    <x-input icon="user" wire:model.defer="state.subdomain" label="Sub-dominio" placeholder="Subdominio" />
                    @error('subdomain')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>
{{--                <div class="col-span-4">--}}
{{--                    <input type="color">--}}
{{--                    <x-color-picker label="Cor de Fundo" placeholder="Cor de Fundo" wire:model="state.color"/>--}}
{{--                    @error('color')--}}
{{--                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="col-span-4">--}}
{{--                    <x-color-picker wire:model.defer="state.text_color" label="Cor do Texto" placeholder="Cor do Texto"  />--}}
{{--                    @error('text_color')--}}
{{--                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                <div class="col-span-4">
                    <x-select
                        label="Status"
                        placeholder="Status"
                        :options="['Ativo', 'Inativo']"
                        wire:model.defer="state.status"
                    />
                    @error('status')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-12 col-span-12">
                    <div class="flex items-start justify-between border-b-2 mt-3 ">
                        Dados do Usuário
                    </div>
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-input icon="user" wire:model.defer="state.user.name" label="Nome"/>
                    @error('user.name')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-6 col-span-12">
                    <x-input icon="mail" type="email" wire:model.defer="state.user.email" label="Email"  />
                    @error('user.email')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-4 col-span-12">
                    <x-inputs.maskable icon="phone"
                                       mask="['(##) ####-####', '(##) #####-####']"
                                       emitFormatted="True"
                                       wire:model.defer="state.user.phone" label="Telefone"
                    />
                    @error('user.phone')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-4 col-span-12">
                    <x-inputs.maskable
                        mask="['###.###.###-##']"
                        icon="user"
                        wire:model.defer="state.user.document" label="CPF"/>
                    @error('user.document')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-4 col-span-12">
                    <x-select
                        label="Status"
                        placeholder="Status"
                        :options="['Ativo', 'Inativo']"
                        wire:model.defer="state.user.status"
                    />
                    @error('user.status')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
{{--                <div class="md:col-span-4 col-span-12">--}}
{{--                    <x-select--}}
{{--                        label="Tipo"--}}
{{--                        :options="['Colaborador', 'Gestão']"--}}
{{--                        wire:model.defer="state.user.type"--}}
{{--                    />--}}
{{--                    @error('user.type')--}}
{{--                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>--}}
{{--                    @enderror--}}
{{--                </div>--}}

                <div class="md:col-span-12 col-span-12">
                    <div class="flex items-start justify-between border-b-2 mt-3 ">
                        Senha
                    </div>
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-inputs.password  label="Senha" wire:model.defer="state.user.password" />
                    {{--                    @error('password') <span class="text-red-600"> {{ $message }} </span>@enderror--}}
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-inputs.password label="Confirmar Senha" wire:model.defer="state.user.password_confirmation" />

                </div>
                <div class="md:col-span-12 col-span-12">
                    @if ($errors->get('user'))
                        <x-errors only="password" title="Campo Senha tem {errors} erros de validação " />
                    @endif
                </div>

                <div class="col-span-12">
                    <x-button type="submit" icon="check" positive label="{{ $client ? 'Atualizar' : 'Cadastrar' }}" />
                </div>
            </div>
        </form>
    </x-card>
</div>

