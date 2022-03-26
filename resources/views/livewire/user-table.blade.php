<div>
    <x-card>
        <x-banner />
        <form action="#" wire:submit.prevent="store()">
            <div class="overflow-hidden shadow-lg sm:rounded-md">
                <div class="px-4 py-5 bg-white  sm:p-6">
                    @if($message!=null)
                    <p class="text-red-600 mb-2">{{$message}}</p>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <div class="col-span-1">
                            @if(Auth::user()->establecimiento_id==null)
                            <x-label for="establecimiento_id" value="SEDE"></x-label>
                            
                            <x-select wire:model="establecimiento_id" class="w-full">
                                <option value="">TODAS LAS SEDES</option>
                                @if($sedes->count()>0)
                                    @foreach ($sedes as $sedev)
                                        <option value="{{$sedev->id}}">{{mb_strtoupper($sedev->nombre)}}</option>
                                    @endforeach
                                @endif
                            </x-select>
                            @else
                            <div class="col-span-1 md:col-span-4">
                                <x-label for="establecimiento_id">Sede</x-label>
                                <p>{{$sede_nombre}}</p>
                            </div>
                            @endif
                            
                        </div>
                        <div class="col-span-1">
                            <x-label for="tipodocumento" value="TIPO DOC"></x-label>

                            <x-select required wire:change="resetdni()" wire:model="tipodocumento" class="w-full">
                                <option value="DNI">DNI</option>
                                <option value="RUC">RUC</option>
                            </x-select>
                            
                        </div>
                        <div class="col-span-1">
                            <x-label for="dni" value="DOCUMENTO"></x-label>
                            <x-input type="number" required wire:model.defer="dni" class="w-full"></x-input>
                        </div>

                        <div class="col-span-1">
                            <x-label for="name" value="NOMBRES Y APELLIDOS"></x-label>
                            <x-input type="text" required wire:model.defer="name" class="w-full"></x-input>
                        </div>
        

                        <div class="col-span-1">
                            <x-label for="password" value="CLAVE"></x-label>
                            @if($estado=='Actualizar')
                            <x-input type="password" wire:model.defer="password" class="w-full"></x-input>
                            @else
                            <x-input type="password" required wire:model.defer="password" class="w-full"></x-input>
                            @endif
                        </div>

                        
        
                        <div class="col-span-1">
                            <x-label for="type"  value="TIPO DE CUENTA"></x-label>
                            <x-select wire:model="type" class="w-full">
                                <option value="administrador">ADMINISTRADOR</option>
                                    <option value="digitador">DIGITADOR</option>
                                    <option value="enfermero">ENFERMERO</option>
                                    <option value="medico">MEDICO</option>
                            </x-select>
                        </div>
                        @if($type=='enfermero')
                       <div class="col-span-1">
                            <x-label for="firma"  value="FIRMA"></x-label>
                            <div class="overflow-hidden relative w-64">
                                <x-button-yellow>
                                    <svg fill="#FFF" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                                    </svg>
                                    <span class="ml-2">Subir Firma</span>
                                </x-button-yellow>
                                <input class="pointer absolute block opacity-0 inset-0" wire:model="firma" type="file" @change="fileName">
                            </div>
                            <div wire:loading wire:target="firma">Cargando...</div>
                            @if(!is_string($firma))
                            @if ($firma)
                                                
                                <img style="max-height: 100px" src="{{ $firma->temporaryUrl() }}">
                                
                            @endif
                            @endif
                            @error('firma') <span class="error">{{ $message }}</span> @enderror
                           
                        </div>
                        @endif
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                 
                    @php
                    $css = 'hidden';

                        if($estado=='Actualizar'){
                            $css = '';
                        }
                    @endphp
                    <x-secondary-button type="button" class="mr-2 {{$css}}" wire:click="cancelar()">
                        Cancelar
                    </x-secondary-button>
                    <x-button type="submit">
                        {{$estado}}
                    </x-button>
                </div>
            </div>
        </form>
    </x-card>
    <x-panel class="mt-5">
        <div class="flex mb-4">
            <div>
                <x-label>USUARIOS</x-label>
                <div class="relative max-w-2xl mr-4">
                    
                    <x-input type="search" name="search" wire:model="inputsearch" autocomplete="off" placeholder="Nombres o DNI" />
                    <div class="absolute right-0 top-0 h-full">
                        <div class="flex items-center h-full px-4">
                            <button type="submit" class="">
                                <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                width="512px" height="512px">
                                <path
                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div>
                <x-label>TIPO DE USUARIO</x-label>
                <x-select wire:model="inputsearchtype" class="w-full">
                    <option value="">ELEGIR</option>
                    <option value="administrador">ADMINISTRADOR</option>
                    <option value="digitador">DIGITADOR</option>
                    <option value="enfermero">ENFERMERO</option>
                    <option value="medico">MEDICO</option>
                </x-select>
            </div>
        </div>
        
        <x-table-responsive>
            <thead>
                <tr>
                    <x-th value="NOMBRES COMPLETOS" class="text-center" />
                    <x-th value="DOCUMENTO" class="text-center" />
                    <x-th value="FIRMAs" class="text-center" />
                    <x-th value="ACCIONES" class="text-center" />
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @if($users->count()>0)     
                @foreach ($users as $user)
                <tr class="">
                    <x-td  class="text-left">
                        <small class="text-sm text-gray-500">{{$user->type}}
                        @if($user->establecimiento_id==null)
                        <span class="text-sm text-red-400">(sin sede)</span>
                    @endif</small><br>
                        {{$user->name}}
                    </x-td>
                    <x-td  class="text-left">
                        <small class="text-sm text-gray-500">{{$user->tipodocumento}}</small><br>
                        {{$user->dni}}
                    </x-td>
                    <x-td  class="text-center">
                        @if($user->firma!=null)
                        <img src="{{asset('firmas/' . $user->firma)}}" class="w-20" alt="">
                        <x-secondary-button wire:click.prevent="eliminarFirma({{$user->id}},'{{$user->firma}}')" class="mt-2">
                            Eliminar Firma
                        </x-secondary-button>
                        @endif
                    </x-td>
                    <x-td  class="text-center w-40">
                        <div class="flex items-center">
                            
                            <x-secondary-button wire:click="editar({{$user->id}})" class="mr-2">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                  </svg> 
                            </x-secondary-button>
                            @if(Auth::user()->id!=$user->id)

                                @if ($user->estado==true)
                                
                                <x-button-green wire:click.prevent="active({{$user->id}},false)" class="mr-2">
                                    <svg aria-hidden="true" class="h-6 w-6 m-auto" focusable="false" data-prefix="fal" data-icon="check-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-check-circle fa-w-16 fa-3x"><path fill="currentColor" d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 464c-118.664 0-216-96.055-216-216 0-118.663 96.055-216 216-216 118.664 0 216 96.055 216 216 0 118.663-96.055 216-216 216zm141.63-274.961L217.15 376.071c-4.705 4.667-12.303 4.637-16.97-.068l-85.878-86.572c-4.667-4.705-4.637-12.303.068-16.97l8.52-8.451c4.705-4.667 12.303-4.637 16.97.068l68.976 69.533 163.441-162.13c4.705-4.667 12.303-4.637 16.97.068l8.451 8.52c4.668 4.705 4.637 12.303-.068 16.97z" class=""></path></svg>
                                </x-button-green>
                                @else
                                <x-button-pink wire:click.prevent="active({{$user->id}},true)" class="mr-2">
                                    <svg aria-hidden="true" class="h-6 w-6 m-auto" focusable="false" data-prefix="fal" data-icon="minus-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-minus-circle fa-w-16 fa-3x"><path fill="currentColor" d="M140 274c-6.6 0-12-5.4-12-12v-12c0-6.6 5.4-12 12-12h232c6.6 0 12 5.4 12 12v12c0 6.6-5.4 12-12 12H140zm364-18c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-32 0c0-119.9-97.3-216-216-216-119.9 0-216 97.3-216 216 0 119.9 97.3 216 216 216 119.9 0 216-97.3 216-216z" class=""></path></svg>
                                </x-button-pink>
                                @endif
                                
                            <x-danger-button wire:click="eliminar({{$user->id}})" title="Eliminar registro">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                  </svg>
                            </x-danger-button>
                            @endif
                        </div>
                    </x-td>
                </tr>    
                @endforeach                 
                
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="100%">
                        @if($users->count()>0) 
                        <div class="bg-white px-4 py-3 items-center  border-t border-gray-200 sm:px-6">
            
                            {{$users->links()}}
                            
                        </div>
                        @endif
                    </th>
                </tr>
            </tfoot>
        </x-table-responsive>
    </x-panel>
</div>
