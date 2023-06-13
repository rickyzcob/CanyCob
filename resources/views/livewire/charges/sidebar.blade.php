<div x-data="{ open: false }">

    <x-button @click="open = !open" orange icon="menu" />

    <div x-show="open"
         x-on:click.stop.outside="open = false"
         x-transition.scale.origin.top
         x-transition:enter.duration.500ms
         x-transition:leave.duration.500ms
    >
        @foreach($response->statusCharge as $index => $price)
            <div>
                <input type="checkbox" id="price{{ $index }}" value="{{ $index }}" wire:model="selected.prices">
                <label for="price{{ $index }}">
                    {{ $price['name'] }} </label>
            </div>
        @endforeach
    </div>
</div>
