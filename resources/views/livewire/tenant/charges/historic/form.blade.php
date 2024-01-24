<div>
    <div class="flex flex-col gap-5">
        <x-card cardClasses="h-80 border-l-4 border-green-500">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                Dados do Franqueado
            </div>
            <div class="flex flex-col items-start  mb-2">
                <div class="justify-between items-center pb-2">
                    <p> <span class="font-bold"> Telefones da franquia :</span> {{$franchising['phone01']}} - {{$franchising['phone02']}} </p>
                </div>
                <div class="justify-between items-center w-full">
                    <p> <span class="font-bold"> Sócios da Unidade : </span>  </p>
                    @foreach($franchising['partners'] as $itemPartner)
                        <p> <span class="font-bold"> Nome : </span> {{$itemPartner['partner']['name'] ? $itemPartner['partner']['name'] : 'Sem Cadastro'}} -
                            <span class="font-bold"> Telefone : </span>{{$itemPartner['partner']['phone'] ? $itemPartner['partner']['phone'] : 'Sem Cadastro'}} -
                            <span class="font-bold"> Email : </span>{{$itemPartner['partner']['email'] ? $itemPartner['partner']['email'] : 'Sem Cadastro'}} </p>
                    @endforeach
                </div>
            </div>
        </x-card>

        <x-card>
            <form wire:submit.prevent="save">
                <div class="flex items-start justify-between border-b-2 mb-5 py-2">
                    Cadastrar nova Cobrança
                    <x-button wire:click="openModal('tenant.charges.simulation.form', {'id': {{$charge['id']}} }, 2)" amber sm icon="plus-circle" label="Simular" />
                </div>
                <div class="grid grid-cols-12 gap-4">
                    <div class="md:col-span-4 col-span-12">
                        <x-select
                            label="Tipo"
                            :options="['Unidade', 'Sócio']"
                            wire:model="state.type"
                        />
                        @error('type')
                        <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($state['type'] == 'Sócio')
                        <div class="md:col-span-8 col-span-12">
                            <x-native-select wire:model="state.partner_id" label="Escolha a quem fazer a Cobrança" >
                                <option value="">Escolha</option>
                                @foreach($response->partners as $itemPartner)
                                    <option value="{{ $itemPartner['partner']['id'] }}"> {{$itemPartner['partner']['name']}}  </option>
                                @endforeach

                            </x-native-select>
                            @error('partner_id')
                            <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <div class="md:col-span-8 col-span-12">
                            <x-input icon="user" wire:model.defer="state.name" label="Com quem Falou"/>
                            @error('name')
                            <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="md:col-span-4 col-span-12">
                        <x-inputs.maskable
                            icon="phone-outgoing"
                            mask="['(##) ####-####', '(##) #####-####']"
                            emitFormatted="True"
                            label="Telefone"
                            wire:model.defer="state.phone"  />
                        @error('phone')
                        <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md:col-span-4 col-span-12">
                        <x-select
                            label="Origem ?"
                            :options="['Ativo', 'Receptivo']"
                            wire:model.defer="state.origin"
                        />
                        @error('origin')
                        <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="md:col-span-4 col-span-12">
                        <x-select
                            label="Atendeu ?"
                            :options="['Sim', 'Não']"
                            wire:model="state.answered"
                        />
                        @error('answered')
                        <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="md:col-span-3 col-span-12">
                        <x-select
                            label="Sucesso ?"
                            :options="['Sim', 'Não']"
                            wire:model="state.success"
                        />
                        @error('success')
                        <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                        @enderror
                    </div>
                    @if($state['success'] == 'Não')
                    <div class="md:col-span-5 col-span-12">
                        <x-datetime-picker
                            label="Reagendar"
                            parse-format="YYYY-MM-DD HH:mm"
                            wire:model.defer="state.date_schedule"
                        />
                        @error('date_schedule')
                        <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                        @enderror
                    </div>
                        @elseif($state['success'] == 'Sim' && auth()->user()->value_agreement > $charge['total_amount_corrected'])
                        <div class="md:col-span-5 col-span-12">
                            <x-datetime-picker
                                label="Data Conferencia"
                                parse-format="YYYY-MM-DD HH:mm"
                                wire:model.defer="state.date_conference"
                            />
                            @error('date_conference')
                            <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="md:col-span-12 col-span-12">
                        <div class="styled-2">
                        <x-textarea wire:model="state.description" label="Descrição" />
                        @error('description')
                        <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="col-span-12">
                        <x-button type="submit" icon="check" positive label="Cadastrar" />
                    </div>
                </div>
            </form>
        </x-card>
    </div>
</div>
