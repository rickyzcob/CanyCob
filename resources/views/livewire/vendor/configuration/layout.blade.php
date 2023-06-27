<div>
{{--    @dd(session('tenant'))--}}
    <x-card>
        <form wire:submit.prevent="update">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
             Cores do Sistema
            </div>
            <div class="grid grid-cols-12 gap-4 p-5">
                <div class="col-span-12">
                    <div wire:ignore  class="colorPicker"></div>
                    <div class="hidden" id="values"></div>
                    <div class="pt-2">
                        <x-input id="hexInput" wire:model.defer="color" label="Cor de Fundo" placeholder="Selecione a Cor" />
                    </div>
                </div>
                <div class="col-span-12">
                    <x-button type="submit" icon="check" spinner="save" positive label="Atualizar" />
                </div>
            </div>
        </form>
    </x-card>
</div>

@push('body-scripts')
    @once
        <script>
            var colorPicker = new iro.ColorPicker(".colorPicker", {
                // color picker options
                // Option guide: https://iro.js.org/guide.html#color-picker-options
                width: 340,
                height: 260,
                color: "rgb(255, 0, 0)",
                borderWidth: 1,
                borderColor: "#fff",
                layout: [
                    {
                        component: iro.ui.Box,
                    },
                    {
                        component: iro.ui.Slider,
                        options: {
                            id: 'hue-slider',
                            sliderType: 'hue'
                        }
                    }
                ]
            });

            var values = document.getElementById("values");
            var hexInput = document.getElementById("hexInput");
            var rgbValue = [];

            // var color =


            // https://iro.js.org/guide.html#color-picker-events
            colorPicker.on(["color:init", "color:change"], function(color){
                // Show the current color in different formats
                // Using the selected color: https://iro.js.org/guide.html#selected-color-api
                values.innerHTML = [
                    "hex: " + color.hexString,
                    "rgb: " + color.rgbString,
                    "hsl: " + color.hslString,
                ].join("<br>");

                hexInput.value = color.hexString;
                rgbValue.value = color.rgbString;

            });

            function setColor() {

                const toRGBArray = rgbStr => rgbStr.match(/\d+/g).map(Number);
                var rgbArray = toRGBArray(rgbValue.value);


                var result = Math.round(((parseInt(rgbArray[0]) * 299) +
                    (parseInt(rgbArray[1]) * 587) +
                    (parseInt(rgbArray[2]) * 114)) / 1000);

                var textColor = (result > 125) ? '#000000' : '#ffffff';

                $('.primary-text-color').css('color', textColor);
                $('.primary-color').css('background-color', hexInput.value);
                localStorage.setItem('bgcolor', hexInput.value);

            @this.set('color', hexInput.value, true);
            }


            function getColor() {

            }
            colorPicker.on('color:change', setColor);

        </script>
    @endonce
@endpush



