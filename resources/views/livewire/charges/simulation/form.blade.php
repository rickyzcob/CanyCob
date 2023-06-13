<div>
    <x-card cardClasses="mb-5">
        <form wire:submit.prevent="simulate">
            <div class="flex items-start justify-between border-b-2 mb-5 py-2">
                Cadastrar nova Cobrança
            </div>

            <div class="grid grid-cols-12 gap-4">
                <div class="md:col-span-3 col-span-12">
                    <x-inputs.currency  prefix="R$ " thousands="." decimal="," wire:model.defer="state.amount" label="Valor Devido"/>
                    @error('amount')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-inputs.currency prefix="R$ " thousands="." decimal="," wire:model.defer="state.entry" label="Entrada"/>
                    @error('entry')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-inputs.number wire:model.defer="state.installments" label="Parcelas" />
                    @error('installments')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-3 col-span-12">
                    <x-datetime-picker
                        label="Data Vencimento"
                        without-time="true"
                        parse-format="YYYY-MM-DD"
                        wire:model.defer="state.due_date"
                    />
                    @error('due_date')
                    <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12">
                    <x-button type="submit" icon="check" spinner="save" loading-delay="longer" positive label="Simular" />
                </div>
            </div>
        </form>
    </x-card>

    @if($simulate)
        <x-card>
            <div class="flex items-start justify-between border-b-2 mb-2">
                <h1 class="text-base text-gray-600 font-semibold py-2">Resultado da Simulação</h1>
            </div>
            <table class="tables">
                <thead>
                <tr>
                    <th width="250px">Nome</th>
                    <th>Vencimento</th>
                    <th>Valor</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody>
                @foreach($simulate as $itemRelease)
                    <tr>
                        <td>Parcela {{ $itemRelease['installment'] }} </td>
                        <td>{{ formatDate($itemRelease['due_date'] ) }}</td>
                        <td>{{ formatMoney($itemRelease['amount'] )}}</td>
                        <td><x-badge color="positive" label="Gerando" /></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </x-card>
    @endif
</div>
