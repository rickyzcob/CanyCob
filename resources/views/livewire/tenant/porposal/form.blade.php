<div>
{{--    <form wire:submit.prevent="submit">--}}
        <div class="grid grid-cols-12 gap-4 p-5 ">
            <div class="md:col-start-4  md:col-span-6 col-span-12">
                <x-inputs.maskable
                    wire:loading.attr="disabled"

                    mask="['###.###.###-##']"
                    wire:model.defer="cpf" />
            </div>
{{--            <div class="  col-span-12">--}}
{{--                <x-button type="submit" icon="check" positive label="Enviar" />--}}
{{--            </div>--}}
        </div>
{{--    </form>--}}
</div>
