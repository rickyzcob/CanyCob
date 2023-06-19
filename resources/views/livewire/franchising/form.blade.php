<div>

    <x-card>
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                {{ $franchising ? 'Atualizar' : 'Cadastrar' }}
            </div>

            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-5 col-span-12">
                    <x-input  wire:model.defer="state.name" label="Unidade"/>
                    @error('name')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="md:col-span-7 col-span-12">
                    <x-input  wire:model.defer="state.razao_social" label="Razão Social"/>
                    @error('razao_social')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-native-select label="Atendente" wire:model="state.attendant_id">
                        @foreach($response->attendants as $itemAttendant)
                        <option value="{{ $itemAttendant['id'] }}" >{{ $itemAttendant['name'] }}</option>

                        @endforeach
                    </x-native-select>
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-input  wire:model.defer="state.supervisor" label="Supervisor"/>
                    @error('supervisor')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
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
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-input  wire:model.defer="state.cnpj" label="CNPJ"/>
                    @error('cnpj')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-input  wire:model.defer="state.insc" label="Ins. Estadual"/>
                    @error('insc')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-input  wire:model.defer="state.cro" label="CRO"/>
                    @error('cro')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 col-span-12">
                    <x-input  wire:model.defer="state.cadeiras_ativas" label="Cad. Ativas"/>
                    @error('cadeiras_ativas')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 col-span-12">
                    <x-input  wire:model.defer="state.cadeiras_capacidade" label="Cad. Cap."/>
                    @error('cadeiras_capacidade')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-12 col-span-12">
                    <div class="flex items-start justify-between border-b-2 mt-5">
                        Responsável CRO
                    </div>
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-input  wire:model.defer="state.resposavel_tecnico" label="Responsável CRO"/>
                    @error('resposavel_tecnico')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-input  wire:model.defer="state.responsavel_tecnico_cro" label="CRO"/>
                    @error('responsavel_tecnico_cro')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-12 col-span-12">
                    <div class="flex items-start justify-between border-b-2 mt-5 ">
                        Endereço
                    </div>
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-input  wire:model.defer="state.cep" label="CEP"/>
                    @error('cep')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-input wire:model.defer="state.address" label="Endereço"/>
                    @error('address')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-input wire:model.defer="state.number" label="Numero"/>
                    @error('number')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-input wire:model.defer="state.complement" label="Complemento"/>
                    @error('complement')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 col-span-12">
                    <x-input wire:model.defer="state.bairro" label="Bairro"/>
                    @error('bairro')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-input wire:model.defer="state.country" label="País"/>
                    @error('country')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-input wire:model.defer="state.city" label="Cidade"/>
                    @error('city')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 col-span-12">
                    <x-input wire:model.defer="state.state" label="Estado"/>
                    @error('state')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 col-span-12">
                    <x-input wire:model.defer="state.populacao" label="População"/>
                    @error('populacao')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12">
                    <div class="flex items-start justify-between border-b-2 mb-5 ">
                        Formas de contato
                    </div>
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-input wire:model.defer="state.phone01" label="Telefone 01"/>
                    @error('phone01')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-input wire:model.defer="state.phone02" label="Telefone 02"/>
                    @error('phone02')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-input wire:model.defer="state.whatsapp" label="Whatsapp"/>
                    @error('whatsapp')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-input wire:model.defer="state.site" label="Site"/>
                    @error('site')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-input icon="mail" wire:model.defer="state.email_site" label="Email Site"/>
                    @error('email_site')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-input icon="mail" wire:model.defer="state.email" label="Email"  />
                    @error('email')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-inputs.maskable
                        mask="['(##) ####-####', '(##) #####-####']"
                        emitFormatted="True"
                        label="Telefone"
                        wire:model.defer="state.phone"  />
                    @error('phone')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12">
                    <x-button type="submit" icon="check" spinner="save" positive label="{{ $franchising ? 'Atualizar' : 'Cadastrar' }}" />
                </div>
            </div>
        </form>
    </x-card>
</div>



