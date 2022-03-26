<div class="p-5">
    <x-confirmation-modal wire:model="preguntarporeliminar">
        <x-slot name="title">
            Notificación
        </x-slot>
        <x-slot name="content">
            Desea realmente eliminar este registro?
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button type="button" wire:click.pevent="$toggle('preguntarporeliminar')" wire:loading.attr="disabled">
                NO
            </x-secondary-button>
            <x-button type="button" wire:click.pevent="eliminarPaciente()" wire:loading.attr="disabled">
                Eliminar
            </x-button>
        </x-slot>
    </x-confirmation-modal>
    <x-form-modal wire:model="isModalCompanion" submit="storeCompanion()">
        <x-slot name="title">
            AGREGAR ACOMPAÑANTE
        </x-slot>
    
        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <x-label for="companion_tipodocumento" value="TIPO DE DOC." />
                    <x-select  wire:model="companion_tipodocumento" class="w-full">
                        @foreach($tipodocumentos as $indexDoc => $textDoc)
                        <option value="{{$indexDoc}}">{{$textDoc}}</option>
                        @endforeach
                    </x-select>
                </div>
                <div class="col-span-1">
                    <x-label for="name" value="DOCUMENTO" />
                    <x-input  wire:model.defer="companion_documento" class="w-full" type="text"  required autocomplete="off" />
                </div>
                <div class="col-span-1">
                    <x-label for="companion_nombres" value="NOMBRES Y APELLIDOS" />
                    <x-input  wire:model.defer="companion_nombres" class="w-full" type="text"  required autocomplete="off" />
                </div>
                <div class="col-span-1">
                    <x-label for="companion_telefono" value="TELÉFONO" />
                    <x-input  wire:model.defer="companion_telefono" class="w-full" type="text" autocomplete="off" />
                </div>
                <div class="col-span-1">
                    <x-label for="companion_tipo" value="TIPO DE ACOMPAÑANTE" />
                    <x-select  wire:model.defer="companion_tipo" class="w-full">
                        <option value="">SELECCIONAR</option>
                        <option value="PAPA">PAPA</option>
                        <option value="MAMA">MAMA</option>
                        <option value="HERMANO(A)">HERMANO(A)</option>
                        <option value="TIO(A)">TIO(A)</option>
                        <option value="OTROS">OTROS</option>
                    </x-select>
                </div>
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('isModalCompanion')" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
    
            <x-button class="ml-2" type="submit">
                REGISTRAR ACOMPAÑANTE
            </x-button>
        </x-slot>
    </x-form-modal>
  
    <x-card>
        <x-banner/>
        <form action="#" id="registroform" method="POST" wire:submit.prevent="store()">
                   
            <input type="hidden" name="registro_id" value="{{$registro_id}}">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-8 gap-6">
                    
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        
                        <x-label for="tipodocumento" value="TIPO DE DOC." />
                        <x-select  wire:model="tipodocumento" required class="w-full">
                            @foreach($tipodocumentos as $indexDoc => $textDoc)
                            <option value="{{$indexDoc}}">{{$textDoc}}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="documento" value="DOCUMENTO" />
                        <div class="relative">
                            <x-input type="text" wire:model.defer="documento" required autocomplete="off" class="w-full"/>
                            <x-button type="button" wire:click.prevent="searchfromdoc()" class="absolute right-1 top-2">
                                <svg aria-hidden="true" class="w-4 h-4" focusable="false" data-prefix="fal" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-search fa-w-16 fa-3x"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z" class=""></path></svg>
                            </x-button>
                        </div>
                        <p>{{$message_search}}</p>
                        <div wire:loading wire:target="searchfromdoc">
                            Buscando...
                        </div>
                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="nombres" value="NOMBRES Y APELLIDOS" />
                        <x-input type="text" wire:model="nombres" required autocomplete="off" class="w-full"/>
                    </div>

    
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="fechanacimiento" value="FECHA DE NACIMIENTO" />
                        <x-input type="text" wire:model.debounce.1000ms="fechanacimiento" placeholder="dd-mm-yyyy" required autocomplete="off" class="w-full"/>
                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="telefono" value="TELEFONO" />
                        <x-input type="text" wire:model.defer="telefono" autocomplete="off" class="w-full"/>
                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="grupoderiesgo" value="GRUPO DE RIESGO" />
                        <x-select wire:model="grupoderiesgo" required  class="w-full">
                            <option value="">ELEGIR GRUPO DE RIESGO</option>
                            @if($riesgos->count()>0)
                                @foreach ($riesgos as $riesgo)
                                    <option value="{{$riesgo->riesgo}}">{{$riesgo->riesgo}}</option>
                                @endforeach
                            @endif
                        </x-select>
                       

                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="edad" value="EDAD" />
                        <x-input type="text" wire:model="edad" required autocomplete="off" class="w-full"/>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <div
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false,Livewire.emit('agregarimagen')"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >

                            <x-label for="foto" value="ADJUNTAR" />
                            <div class="overflow-hidden relative w-64">
                                <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 w-auto pointer inline-flex items-center rounded ">
                                    <svg fill="#FFF" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                                    </svg>
                                    <span class="ml-2">TOMAR FOTO</span>
                                </button>
                                <input class="pointer absolute block opacity-0 inset-0" wire:model="foto" type="file" >
                            </div>
                            <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div>
                            @error('foto') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="dosis" value="DOSIS" />{{$dosis_mensaje}}
                        <x-select wire:model.defer="dosis" required class="w-full">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </x-select>
                    </div>

                    <div class="col-span-8 lg:col-span-4">
                        <x-label for="domicilio" value="DIRECCIÓN" />
                        <x-input type="text" wire:model.defer="domicilio" required autocomplete="off" class="w-full"/>
                    </div>

                
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                
                
                <x-secondary-button type="button" wire:click.pevent="openModalCompanion()">
                    AGREGAR ACOMPAÑANTE
                    <svg aria-hidden="true" class="w-5 h-5 ml-2" focusable="false" data-prefix="fal" data-icon="user-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-user-plus fa-w-20 fa-3x"><path fill="currentColor" d="M632 224h-88v-88c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8v88h-88c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h88v88c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-88h88c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm-318.4 64c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4zM416 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16v-41.6C32 365.9 77.9 320 134.4 320c19.6 0 39.1 16 89.6 16 50.4 0 70-16 89.6-16 56.5 0 102.4 45.9 102.4 102.4V464zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0-224c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" class=""></path></svg>
                </x-secondary-button>
                @if($sepuederegistrar)
                <x-button type="submit">
                    {{$textbtn}}
                    <svg aria-hidden="true" class="w-5 h-5 ml-2" focusable="false" data-prefix="fal" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-plus fa-w-12 fa-3x"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z" class=""></path></svg>
                </x-button>
                @endif
                @if($registro_id!='')
                <a href="{{route('dashboard')}}" class="cancelar inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    CANCELAR
                    
                </a>
                @endif
            </div>
        </form>
    </x-card>
    @if(is_array($companions) && count($companions)>0)
    <x-panel class="mt-5">
        <p class="text-lg mb-5">Acompañantes</p>
        <x-table-responsive>
            <thead>
                <tr>
                    <x-th value="Tipo de documento" class="text-center" />
                    <x-th value="Documento" class="text-center" />
                    <x-th value="Nombres completos" class="text-left"/>
                    <x-th value="Teléfono" class="text-center"/>
                    <x-th value="Tipo" class="text-center"/>
                    <x-th value="Acciones" class="text-center"/>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">   
                
                    @foreach ($companions as $companion_id => $companion)
                    <tr class="">
                        
                        <x-td value="{{$tipodocumentos[$companion['tipodocumento']]}}" class="text-center" />
                        <x-td value="{{$companion['documento']}}" class="text-center" />
                        <x-td value="{{$companion['nombres']}}" class="text-left" />
                        <x-td value="{{$companion['telefono']}}" class="text-center" />
                        <x-td value="{{$companion['tipo']}}" class="text-center" />

                        <x-td  class="text-center w-40">
                            <div class="flex items-center">
                                <x-danger-button type="button" wire:click="deleteCompanion({{$companion_id}})">
                                    Eliminar <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                </x-danger-button>
                            </div>
                        </x-td>
                    </tr>    
                    @endforeach   
                    
            </tbody>
        </x-table-responsive>
    </x-panel>
    @endif  
    @if(is_array($fotos) && count($fotos)>0)
    <x-panel class="mt-5">
        <p class="text-lg mb-5">Documentos adjuntados</p>
        
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-8 gap-3">
            @foreach ($fotos as $indexDic => $doc)
                <div class="col-span-1">
                    <div class="bg-gray-800 flex items-center justify-center" style="height: 150px">
                        <img src="{{asset('firmas/' . $doc['imagen'])}}" class="w-full" style="max-height: 150px">
                    </div>
                    
                    <x-secondary-button type="button" class="mt-2" wire:click="eliminarDic({{$indexDic}})">
                        Eliminar
                    </x-secondary-button>
                </div>
            @endforeach
        </div>
        
    </x-panel>
    @endif
    
    @if($pacientes!=null)
    @if($pacientes->count()>0)
    
    <x-panel class="mt-5">
        <p class="text-lg mb-5">Usuarios por atender</p>
        
        <x-table-responsive>
            <thead>
                <tr>
                    <x-th value="NOMBRES Y APELLIDOS" class="text-left" />
                    <x-th value="EDAD" class="text-center" />
                    <x-th value="GRUPO DE RIESGO" class="text-left" />
                    <x-th value="ADJUNTO" class="text-left" />
                    <x-th value="MÓDULO DE ADMISION" class="text-center" />
                    <x-th value="ESTADO" class="text-center" />
                    <x-th value="ACCIÓN" class="text-center" />
                </tr>
            </thead>
            <tbody>
                @foreach($pacientes as $paciente)
                    <tr>
                        <x-td class="text-left">
                            {{$paciente->nombres}}
                            @if($paciente->companions->count()>0)
                            <x-label value="ACOMPAÑANTES:" class="font-bold mt-2" />
                            <ul>
                            @foreach($paciente->companions as $companion)
                            <li>{{$companion->nombres}} con {{$companion->tipodocumento}}:{{$companion->documento}} y tel:{{$companion->telefono}} y tipo:{{$companion->tipo}}  </li>
                            @endforeach
                            </ul>
                            @endif
                        </x-td>
                        <x-td value="{{$paciente->edad}}" class="text-center" />
                        <x-td value="{{$paciente->grupoderiesgo}}" class="text-left" />
                        <x-td class="text-left">
                            @if($paciente->archivos_adjuntos->count()>0)
                            <div style="max-width:166px">
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach($paciente->archivos_adjuntos as $adjunto)
                                    <div class="col-span-1">
                                        <div class="bg-gray-800 flex items-center justify-center" style="height: 100px">
                                            <img src="{{asset('/firmas/' . $adjunto->nombrearchivo)}}" class="w-full object-cover" style="max-height: 100px">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            @endif
                        </x-td>
                        <x-td value="{{$paciente->modulo_admision}}" class="text-center" />
                        <x-td value="{{$paciente->estado}}" class="text-center" />
                        <x-td class="text-center">
                            <x-danger-button type="button" wire:click.prevent="PorEliminarPaciente({{$paciente->id}})">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </x-danger-button>
                        </x-td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="100%">
                        {{$pacientes->links()}}
                    </th>
                </tr>
            </tfoot>
        </x-table-responsive>
        
    </x-panel>
    @endif
    @endif

</div>