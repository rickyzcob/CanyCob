<div>
    <x-card cardClasses="border-l-4 border-green-500">
        <form wire:submit.prevent="save">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                {{ $paymentMethod ? 'Atualizar' : 'Cadastrar' }}
            </div>
            <div class="grid grid-cols-12 gap-4">

                <div class="md:col-span-4 col-span-12">
                    <x-select
                        label="Tipo"
                        placeholder="Tipo"
                        :options="['Cartão Crédito', 'Cartão Débito', 'Pix', 'Boleto', 'Link  de Pagamento']"
                        wire:model.defer="state.type"
                    />
                    @error('type')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 col-span-12">
                    <x-input  wire:model.defer="state.code" label="Codigo">
                        <x-slot name="append">
                            <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                                <x-button
                                    class="h-full rounded-r-md"
                                    wire:click.prevent="getBankbyCode()"
                                    icon="search"
                                    primary
                                    flat
                                    squared
                                />
                            </div>
                        </x-slot>
                    </x-input>

                    @error('code')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <x-input icon="office-building" wire:model="state.bank" label="Banco"/>
                    @error('bank')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-input  wire:model.defer="state.agency" label="Agencia"/>
                    @error('agency')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-4 col-span-12">
                    <x-input  wire:model.defer="state.count" label="Conta"/>
                    @error('count')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2 col-span-12">
                    <x-input  wire:model.defer="state.bill" label="Cart."/>
                    @error('bill')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
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

                <div class="col-span-12">
                    <x-button type="submit" icon="check" spinner="save" positive label="{{ $paymentMethod ? 'Atualizar' : 'Cadastrar' }}" />
                </div>
            </div>
        </form>
    </x-card>
</div>
