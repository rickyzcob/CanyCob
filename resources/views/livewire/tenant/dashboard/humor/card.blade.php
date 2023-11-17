<div>
    <x-card cardClasses="min-h-24">
        <div class="flex flex-col w-full items-center justify-center w-full p-5 bg-blue-50">
            <div>
                <h1 class="text-sky-800" >Como você está se sentindo ?</h1>
            </div>
            <div class="p-5">
                <form wire:submit.prevent="submit">
                    <div class="flex items-center justify-center gap-2 w-96 p-3">
                        <label>
                            <input type="radio" wire:model.defer="state.humor" name="humor" value="1">
                            <img src="{{ url('img/emojis/emoji_1.png') }}" class="w-8 h-8" alt="Option 1">
                        </label>
                        <label>
                            <input type="radio" wire:model.defer="state.humor" name="humor" value="2" >
                            <img src="{{ url('img/emojis/emoji_2.png') }}" class="w-8 h-8" alt="Option 1">
                        </label>
                        <label>
                            <input type="radio" wire:model.defer="state.humor" name="humor" value="3" >
                            <img src="{{ url('img/emojis/emoji_3.png') }}" class="w-8 h-8" alt="Option 1">
                        </label>
                        <label>
                            <input type="radio" wire:model.defer="state.humor" name="humor" value="4" >
                            <img src="{{ url('img/emojis/emoji_4.png') }}" class="w-8 h-8" alt="Option 1">
                        </label>
                        <label>
                            <input type="radio" wire:model.defer="state.humor" name="humor" value="5" >
                            <img src="{{ url('img/emojis/emoji_5.png') }}" class="w-8 h-8" alt="Option 1">
                        </label>
                    </div>
                    @error('state.humor')
                    <div class="text-red-800 text-sm p-1">{{ $message }}</div>
                    @enderror
                    <div class="p-2 w-full">
                        <x-textarea wire:model.defer="state.description" placeholder="Nos conte o que te faz sentir assim !!! " />
                    </div>

            </div>

            <div>
                <p class="italic">Algumas pessoas já responderam</p>
            </div>

            <div class="flex mb-5 -space-x-3">
                <x-avatar md src="https://picsum.photos/295?size=24x" />
                <x-avatar md src="https://picsum.photos/300?size=24x" />
                <x-avatar md src="https://picsum.photos/301?size=24x" />
                <x-avatar md src="https://picsum.photos/305?size=24x" />
                <x-avatar md src="https://picsum.photos/299?size=24x" />
                <x-avatar md src="https://picsum.photos/280?size=24x" />
            </div>

            <x-button type="submit" icon="check" positive label="Enviar" />

            </form>
        </div>
    </x-card>
</div>
