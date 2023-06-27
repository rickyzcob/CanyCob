<div>
    <x-card>
        <form wire:submit.prevent="update">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                Atualizar Senha
            </div>
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-inputs.password  label="Senha" wire:model.defer="state.password" />
                </div>
                <div class="col-span-12">
                    <x-inputs.password label="Confirmar Senha" wire:model.defer="state.password_confirmation" />
                </div>
                <div class="col-span-12">
                    @if ($errors->get('password'))
                        <x-errors only="password" title="Campo Senha tem {errors} erros de validação " />
                    @endif
                </div>
                <div class="col-span-12">
                    <x-button type="submit" icon="check" spinner="update" positive label="Atualizar" />
                </div>
            </div>
        </form>
    </x-card>
</div>


