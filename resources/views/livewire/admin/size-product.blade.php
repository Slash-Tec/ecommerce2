<div>
    <div class="bg-white shadow-lg rounded-lg p-6 mt-12">
        <div>
            <x-jet-label>
                Cantidad
            </x-jet-label>
            <x-jet-input
                wire:model="name"
                type="text"
                placeholder="Introduzca una talla"
                class="w-full"/>
            <x-jet-input-error for="name" />
        </div>

        <div class="flex justify-end items-center mt-4">
            <x-jet-button wire:click="save" wire:loading.attr="disabled" wire:target="save">
                Agregar
            </x-jet-button>
        </div>
    </div>

    <ul class="mt-12 space-y-4">
        @foreach ($sizes as $size)
            <li class="bg-white shadow-lg rounded-lg p-6" wire:key="size-{{ $size->id }}">
                <div class="flex items-center">
                    <span class="text-xl font-medium">{{ $size->name }}</span>

                    {{--<div class="ml-auto">

                        <x-jet-button wire:click="edit({{ $size->id }})" wire:loading.attr="disabled"
                                      wire:target="edit({{ $size->id }})">
                            <i class="fas fa-edit"></i>
                        </x-jet-button>

                        <x-jet-danger-button wire:click="$emit('deleteSize', {{ $size->id }})">
                            <i class="fas fa-trash"></i>
                        </x-jet-danger-button>

                    </div>--}}
                </div>

{{--                @livewire('admin.color-size', ['size' => $size], key('color-size-' . $size->id))--}}
            </li>
        @endforeach
    </ul>
</div>
