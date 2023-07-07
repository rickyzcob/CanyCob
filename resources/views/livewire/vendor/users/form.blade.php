    <div>
    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                {{ $user ? 'Atualizar' : 'Cadastrar' }}
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-6 col-span-12">
                    <x-input icon="user" wire:model.defer="state.name" label="Nome"/>
                    @error('name')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-6 col-span-12">
                    <x-input icon="mail" type="email" wire:model.defer="state.email" label="Email"  />
                    @error('email')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-4 col-span-12">
                    <x-inputs.maskable icon="phone"
                         mask="['(##) ####-####', '(##) #####-####']"
                         emitFormatted="True"
                         wire:model.defer="state.phone" label="Telefone"
                    />
                    @error('phone')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-4 col-span-12">
                    <x-inputs.maskable
                        mask="['###.###.###-##']"
                        icon="user"
                        wire:model.defer="state.document" label="CPF"/>
                    @error('document')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-4 col-span-12">
                    <x-select
                        label="Status"
                        placeholder="Status"
                        :options="['Ativo', 'Inativo']"
                        wire:model.defer="state.status"
                    />
                    @error('status')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-4 col-span-12">
                    <x-select
                        label="Tipo"
                        :options="['Colaborador', 'Gestão']"
                        wire:model.defer="state.type"
                    />
                    @error('type')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-4 col-span-12">
                    <div class="styled-1">
                        <x-native-select wire:model.defer="state.role_id" label="Permissão" >
                            <option value=""></option>
                            @foreach($response->roles as $itemRole)
                                <option value="{{$itemRole['id']}}">{{$itemRole['name']}}</option>
                            @endforeach
                        </x-native-select>
                        @error('role_id')
                        <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="md:col-span-4 col-span-12">
                    <div class="styled-1">
                        <x-inputs.currency  prefix="R$ " thousands="." decimal="," wire:model.defer="state.value_agreement" label="Valor Acordo"/>
                        @error('value_agreement')
                        <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="md:col-span-12 col-span-12">
                <div class="flex items-start justify-between border-b-2 mt-3 ">
                    Senha
                </div>
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-inputs.password  label="Senha" wire:model.defer="state.password" />
{{--                    @error('password') <span class="text-red-600"> {{ $message }} </span>@enderror--}}
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-inputs.password label="Confirmar Senha" wire:model.defer="state.password_confirmation" />

                </div>
                <div class="md:col-span-12 col-span-12">
                @if ($errors->get('password'))
                    <x-errors only="password" title="Campo Senha tem {errors} erros de validação " />
                @endif
                </div>
{{--                @foreach ($messages->get('password') as $message)--}}
{{--                {{$message}}--}}
{{--                @endforeach--}}
                <div class="col-span-12">
                    <x-button type="submit" spinner="save" icon="check" positive label="{{ $user ? 'Atualizar' : 'Cadastrar' }}" />
                </div>
            </div>
        </form>
    </x-card>
</div>

