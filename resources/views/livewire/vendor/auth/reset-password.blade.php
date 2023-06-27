<div>
    <div class="flex flex-col items-center justify-center">
        <h4 class="mb-5">Alterar Senha</h4>
        <p >Use o formulário abaixo para alterar a sua nova senha </p>
    </div>

    <form wire:submit.prevent="submit">
        <div class="md:grid grid-cols-1 gap-4 p-5">
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
            <div class="flex justify-items-center py-2">
                <x-button type="submit" sky label="Alterar Senha" />
            </div>
        </div>

{{--        <div class="form-group m-t-10 mb-0 row">--}}
{{--            <div class="col-12 m-t-20">--}}
{{--                <x-nua href="{{route('password.request')}}" class="text-muted"><i class="mdi mdi-lock"></i> Voltar </x-nua>--}}
{{--            </div>--}}
{{--        </div>--}}
    </form>
</div>
</div>


