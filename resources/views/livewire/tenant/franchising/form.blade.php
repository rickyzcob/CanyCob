<div>
    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                {{ $franchising ? 'Atualizar' : 'Cadastrar' }}
            </div>

            <div class="grid grid-cols-12 items-end gap-4">
                <div class="md:col-span-6 col-span-12">
                    <x-input  wire:model.defer="state.name" label="Unidade"/>
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

                <div class="md:col-span-12 col-span-12">
                    <x-input  wire:model.defer="state.corporate_name" label="Razão Social"/>
                    @error('corporate_name')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-inputs.maskable
                        mask="['##.###.###/####-##']"
                        emitFormatted="True"
                        wire:model.lazy="state.employer_number" label="CNPJ"/>
                    @error('employer_number')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-input maxlength="9"  wire:model.defer="state.state_registration" label="Ins. Estadual"/>
                    @error('state_registration')
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
                    <div class="styled-1">
                        <x-native-select label="Atendente" wire:model.defer="state.attendant_id">
                            <option value="" ></option>
                            @foreach($response->attendants as $itemAttendant)
                            <option value="{{ $itemAttendant['id'] }}" >{{ $itemAttendant['name'] }}</option>
                            @endforeach
                        </x-native-select>
                        @error('attendant_id')
                        <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="md:col-span-12 col-span-12">
                    <div class="flex items-start justify-between border-b-2 mt-5 ">
                        Endereço
                    </div>
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-input
                        x-mask="99999-999"
                        icon="location-marker"
                        wire:model.defer="state.zip_code" label="CEP">
                        <x-slot name="append">
                            <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                                <x-button
                                    class="h-full rounded-r-md"
                                    wire:click.prevent="getDataByZipCode()"
                                    icon="search"
                                    primary
                                    flat
                                    squared
                                />
                            </div>
                        </x-slot>
                    </x-input>

                    @error('zip_code')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

{{--                <div class="md:col-span-1 col-span-12 py-1">--}}
{{--                    <x-button sm warning icon="search" wire:click.prevent="getDataByZipCode()" />--}}
{{--                </div>--}}

                <div class="md:col-span-6 col-span-12">
                    <x-input wire:model="state.address" label="Endereço"/>
                    @error('address')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 col-span-12">
                    <x-input wire:model.defer="state.number" label="Numero"/>
                    @error('number')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-5 col-span-12">
                    <x-input wire:model.defer="state.complement" label="Complemento"/>
                    @error('complement')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-5 col-span-12">
                    <x-input wire:model.defer="state.neighborhood" label="Bairro"/>
                    @error('neighborhood')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 col-span-12">
                    <x-input wire:model.defer="state.country" label="País"/>
                    @error('country')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-input wire:model.defer="state.city" label="Cidade"/>
                    @error('city')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 col-span-12">
                    <x-input wire:model.defer="state.state" label="Estado"/>
                    @error('state')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12">
                    <div class="flex items-start justify-between border-b-2 mb-5 ">
                        Formas de contato
                    </div>
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-inputs.maskable
                        icon="phone"
                        mask="['(##) ####-####', '(##) #####-####']"
                        emitFormatted="True"
                        wire:model.defer="state.phone01" label="Telefone 01"/>
                    @error('phone01')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-inputs.maskable
                        icon="phone"
                        mask="['(##) ####-####', '(##) #####-####']"
                        emitFormatted="True"
                        wire:model.defer="state.phone02" label="Telefone 02"/>
                    @error('phone02')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-inputs.maskable
                        icon="phone"
                        mask="['(##) ####-####', '(##) #####-####']"
                        emitFormatted="True"
                        wire:model.defer="state.whatsapp" label="Whatsapp"/>
                    @error('whatsapp')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-input wire:model.defer="state.site" label="Site"/>
                    @error('site')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-input icon="mail" type="email"  wire:model.defer="state.email_site" label="Email Site"/>
                    @error('email_site')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12 items-start gap-5" >
                    <x-button type="submit" icon="check" spinner="save" positive label="{{ $franchising ? 'Atualizar' : 'Cadastrar' }}" />
                    <x-button wire:click="getDataCNPJ()" spinner icon="information-circle" warning label="Dados Receita" />
                </div>
            </div>
        </form>
    </x-card>
</div>

{{--@push('scripts')--}}

{{--    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>--}}
{{--@endpush--}}

