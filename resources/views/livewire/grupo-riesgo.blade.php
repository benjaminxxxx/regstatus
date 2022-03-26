<div class="p-2 md:p-5">
    <x-confirmation-modal wire:model="preguntarporeliminar">
        <x-slot name="title">
            Notificación
        </x-slot>
        <x-slot name="content">
            Desea realmente eliminar este grupo de riesgo?
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button type="button" wire:click.pevent="$toggle('preguntarporeliminar')" wire:loading.attr="disabled">
                NO
            </x-secondary-button>
            <x-button type="button" wire:click.pevent="eliminar()" wire:loading.attr="disabled">
                Eliminar
            </x-button>
        </x-slot>
    </x-confirmation-modal>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="col-span-1">
            <x-panel>
                <x-label>Vacunas por edades</x-label>
                <div>
                    @if($vacunasPorEdades->count())
                    @foreach ($vacunasPorEdades as $reg1)
                    <div class="block md:flex mt-3 border rounded-lg p-2">
                        <div class="w-24">
                            <img src="{{asset('firmas/grupoderiesgo/' . $reg1->logo)}}" alt="">
                        </div>
                        <div class="bg-white overflow-x-auto w-full">
                            <div class="grid grid-cols-2 gap-1">
                                <div class="col-span-2">
                                    <x-label class="text-center">{{$reg1->riesgo}}</x-label>
                                </div>
                                <div class="col-span-1">
                                    <x-label class="text-center">{{$reg1->min}}</x-label>
                                </div>
                                <div class="col-span-1">
                                    <x-label class="text-center">{{$reg1->max}}</x-label>
                                </div>
                                <div class="col-span-2 text-center">
                                    <x-danger-button wire:click="antes_de_eliminar({{$reg1->id}})">
                                        <svg aria-hidden="true" class="w-4 h-4" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14 fa-3x"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg>
                                    </x-danger-button>
                                </div>
                            </div>
                        </div>              
                    </div>
                    @endforeach
                    @endif
                </div>
                <form action="#" class="block md:flex mt-3" wire:submit.prevent="store(1)">
                    <div class="w-24">
                        <div
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false,Livewire.emit('agregarimagen')"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <x-label for="file" value="LOGO" />
                            <div class="overflow-hidden relative w-24">
                                <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 w-auto pointer inline-flex items-center rounded ">
                                    <svg fill="#FFF" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                                    </svg>
                                </button>
                                <input class="pointer absolute block opacity-0 inset-0" wire:model="file" type="file" >
                            </div>
                            <div x-show="isUploading" class="w-full overflow-x-hidden">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                            @error('file') <span class="error">{{ $message }}</span> @enderror
                            @if($filename!=null)
                            <div class="mt-5 p-2">
                                <div class="bg-white flex items-center justify-center">
                                    <img src="{{asset('firmas/grupoderiesgo/' . $filename)}}" class="w-full" style="max-height: 150px; max-width: 81px;">
                                </div>
                                
                                <x-secondary-button type="button" class="mt-2" wire:click="eliminarFile()">
                                    Eliminar
                                </x-secondary-button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div>
                            <x-input class="w-full" type="text" required wire:model.defer="pegrupoderiesgo" placeholder="Nombre del grupo" />
                        </div>
                        <div class="grid grid-cols-2 gap-1">
                            <x-input class="col-span-1" required placeholder="Mínimo" type="number" wire:model.defer="pemin" />
                            <x-input class="col-span-1" required placeholder="Máximo" type="number" wire:model.defer="pemax" />
                            <div class="col-span-2">
                                <x-button type="submit" class="w-full mt-2 justify-center">
                                    <svg aria-hidden="true" class="w-4 h-4" focusable="false" data-prefix="fal" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-plus fa-w-12 fa-3x"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z" class=""></path></svg>
                                    Agregar
                                </x-button>
                            </div>
                        </div>
                    </div>
                </form>
            </x-panel>
        </div>
        <div class="col-span-1 md:col-span-2">
            <x-panel>
                <x-label>Vacunas por grupo de riesgo</x-label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @if($vacunasPorRiesgo->count())
                    @foreach ($vacunasPorRiesgo as $reg2)
                    <div class="col-span-1">
                        <div class="block md:flex mt-3 border rounded-lg p-2">
                            <div class="w-24">
                                <img src="{{asset('firmas/grupoderiesgo/' . $reg2->logo)}}" alt="">
                            </div>
                            <div class="bg-white overflow-x-auto w-full">
                                <div class="grid grid-cols-2 gap-1">
                                    <div class="col-span-2">
                                        <x-label class="text-center">{{$reg2->riesgo}}</x-label>
                                    </div>
                                    <div class="col-span-2 text-center">
                                        <x-danger-button wire:click="antes_de_eliminar({{$reg2->id}})">
                                            <svg aria-hidden="true" class="w-4 h-4" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14 fa-3x"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg>
                                        </x-danger-button>
                                    </div>
                                </div>
                            </div>              
                        </div>
                    </div>
                    
                    @endforeach
                    @endif
                </div>
                <form action="#" class="block md:flex mt-3" wire:submit.prevent="store(2)">
                    <div class="w-24">
                        <div
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false,Livewire.emit('agregarimagen2')"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <x-label for="file2" value="LOGO" />
                            <div class="overflow-hidden relative w-24">
                                <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 w-auto pointer inline-flex items-center rounded ">
                                    <svg fill="#FFF" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                                    </svg>
                                </button>
                                <input class="pointer absolute block opacity-0 inset-0" wire:model="file2" type="file" >
                            </div>
                            <div x-show="isUploading" class="w-full overflow-x-hidden">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                            @error('file2') <span class="error">{{ $message }}</span> @enderror
                            @if($filename2!=null)
                            <div class="mt-5 p-2">
                                <div class="bg-white flex items-center justify-center">
                                    <img src="{{asset('firmas/grupoderiesgo/' . $filename2)}}" class="w-full" style="max-height: 150px; max-width: 81px;">
                                </div>
                                
                                <x-secondary-button type="button" class="mt-2" wire:click="eliminarFile(2)">
                                    Eliminar
                                </x-secondary-button>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div>
                            <x-input class="w-full" type="text" required wire:model.defer="prgrupoderiesgo" placeholder="Nombre del grupo" />
                        </div>
                        <div class="grid grid-cols-2 gap-1">
                            <div class="col-span-2">
                                <x-button type="submit" class="w-full mt-2 justify-center">
                                    <svg aria-hidden="true" class="w-4 h-4" focusable="false" data-prefix="fal" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-plus fa-w-12 fa-3x"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z" class=""></path></svg>
                                    Agregar
                                </x-button>
                            </div>
                        </div>
                    </div>
                </form>
            </x-panel>
        </div>
    </div>
</div>
