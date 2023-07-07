<div>
    <x-card>
        <form wire:submit.prevent="submit">
            <div class="flex items-start justify-between border-b-2 mb-5 ">
                Atualizar Permissões
            </div>
            <div class="flex flex-col items-start justify-between gap-4 w-full">
                    @foreach($response->groupPermissions as $itemGroup)
                        <div class="w-full">
                        {{ $itemGroup['name'] }}
                            <div class="flex flex-col bg-slate-200 p-2 rounded">
                            @foreach($itemGroup['permissions'] as $key => $itemPermission)
                                <div class="gap-3 py-2">
                                    <input type="checkbox" label="{{$itemPermission['label']}}" value="{{$itemPermission->id}}" wire:model.defer="permissions" />
                                    <label for="vehicle1"> {{$itemPermission['label']}}</label>
{{--                                    <x-checkbox id="right-label" label="{{$itemPermission['label']}}" value="{{$itemPermission->id}}" wire:model="permissions" />--}}
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="py-2">
                    <x-button type="submit" spinner="submit" icon="check" positive label="Atualizar" />
                </div>
            </div>
        </form>
    </x-card>
</div>
