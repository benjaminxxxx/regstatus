<div>
    
    <x-dialog-modal maxWidth="6xl" wire:model="hayMasUsuario">
        <x-slot name="title">
            <p>Se han encontrado más de un registro</p>
            <small>Debe seleccionar el registro que falta vacunar</small>
        </x-slot>
        <x-slot name="content">
            <!-- Table -->
            <div style="max-height: 50vh; overflow-x:auto">
                <x-table-responsive>
                    <thead>
                        <x-th value="NOMBRES COMPLETOS" />
                        <x-th value="APTO" class="text-center" />
                        <x-th value="ESTADO" class="text-center" />
                        <x-th value="GRUPO DE RIESGO" />
                        <x-th value="TRIAJE" />
                        <x-th value="DOSIS N°"  class="text-center"/>
                        <x-th value="ACCIONES"  class="text-center"/>
                    </thead>
                    <tbody>
                        @if($registros!=null)
                        @if($registros->count()>0)
                        @foreach ($registros as $registro)
                        
                        <tr>
                            <x-td>
                                <div>
                                    <p class="">
                                        {{$registro->nombres}}
                                        @if($registro->fechahora!=null)
                                        <br/> <p class="text-red-600 font-bold">Se vacunó: {{$registro->fechahora}}</p>
                                        @endif
                                    </p>
                                    <p class="text-gray-500 text-sm font-semibold tracking-wide">
                                        {{$registro->observacion}}
                                    </p>
                                </div>
                            </x-td>
                            <x-td class="text-center">
                                {{$registro->apto}}
                            </x-td>
                            <x-td class="text-center">
                                
                                @if($registro->estado=='ADMISIÓN')
                                <span class="text-red-800 bg-red-200 font-semibold px-2 rounded-full">
                                    EN ADMISIÓN
                                </span>
                                @elseif($registro->estado=='TRIAJE')
                                <span class="text-yellow-800 bg-yellow-200 font-semibold px-2 rounded-full">
                                    EN TRIAJE
                                </span>
                                @elseif($registro->estado=='VACUNADO')
                                <span class="text-green-800 bg-green-200 font-semibold px-2 rounded-full">
                                    DE ALTA
                                </span>
                                @else
                                {{$registro->estado}}
                                @endif
                            </x-td>
                            <x-td>
                                <p style="max-width: 200px; white-space: pre-wrap; font-size: 11px;">{{$registro->grupoderiesgo}}</p>
                            </x-td>
                            <x-td>
                                <p>{{$registro->modulo_vacunatorio}}</p>
                            </x-td>
                            <x-td  class="text-center">
                                <p>{{$registro->dosis}}</p>
                                <p class="text-gray-500 text-sm font-semibold tracking-wide">
                                    Marca: {{$registro->marca}} 
                                    Lote: {{$registro->lote}}
                                </p>
                            </x-td>
                            <x-td class="text-center">
                                @if($registro->estado!='VACUNADO')
                                <a href="#" wire:click.prevent="autoseleccionar('{{$registro->documento}}',{{$registro->id}})" class="text-purple-800 hover:underline">Elegir este registro</a>
                                @endif
                            </x-td>
                        </tr>
                        @endforeach
                        @endif
    @endif
                    </tbody>
                </x-table-responsive>
            </div>
            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('hayMasUsuario')">
                    Cancelar
                </x-secondary-button>
            </x-slot>
        </x-slot>
        
    </x-dialog-modal>
    
    <x-card>
        <x-banner/>
        <form action="#" id="registroform" method="POST" wire:submit.prevent="store()">
                   
            <input type="hidden" name="registro_id" value="{{$registro_id}}">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-8 gap-6">
                    
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        
                        <x-label for="tipodocumento" value="TIPO DE DOC." />
                        <x-select  wire:model="tipodocumento" class="w-full">
                            @foreach($tipodocumentos as $indexDoc => $textDoc)
                            <option value="{{$indexDoc}}">{{$textDoc}}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="documento" value="DOCUMENTO" />
                        <div class="relative">
                            <x-input type="text" wire:model="documento" required autocomplete="off" class="w-full"/>
                            <x-button type="button" wire:click.prevent="buscarDeTriaje()" class="absolute right-1 top-2">
                                <svg aria-hidden="true" class="w-4 h-4" focusable="false" data-prefix="fal" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-search fa-w-16 fa-3x"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z" class=""></path></svg>
                            </x-button>
                        </div>
                        <div wire:loading wire:target="buscarDeTriaje">
                            Buscando...
                        </div>
                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="nombres" value="NOMBRES Y APELLIDOS" />
                        <x-input type="text" readonly wire:model="nombres" required autocomplete="off" class="w-full bg-gray-100 cursor-not-allowed"/>
                    </div>

    
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="fechanacimiento" value="FECHA DE NACIMIENTO" />
                        <x-input type="text" readonly wire:model.debounce.1000ms="fechanacimiento" placeholder="dd-mm-yyyy" required autocomplete="off" class="w-full bg-gray-100 cursor-not-allowed"/>
                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="telefono" value="TELEFONO" />
                        <x-input type="text" readonly wire:model="telefono" required autocomplete="off" class="w-full bg-gray-100 cursor-not-allowed"/>
                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="edad" value="EDAD" />
                        <x-input type="text" readonly wire:model="edad" required autocomplete="off" class="w-full bg-gray-100 cursor-not-allowed"/>
                    </div>

                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="grupoderiesgo" value="GRUPO DE RIESGO" />
                        <x-select wire:model="grupoderiesgo" disabled required class="w-full bg-gray-100 cursor-not-allowed">
                            <option value="">SIN RIESGO</option>
                            @if($riesgos->count()>0)
                                @foreach ($riesgos as $riesgo)
                                    <option value="{{$riesgo->riesgo}}">{{$riesgo->riesgo}}</option>
                                @endforeach
                            @endif
                        </x-select>

                    </div>

                    

                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="domicilio" value="DIRECCIÓN" />
                        <x-input type="text" wire:model="domicilio" required autocomplete="off" class="w-full"/>
                    </div>

                    @if ($registro_id!=null)
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        
                        <x-label for="marca" value="MARCA DE LA VACUNA" />
                        <x-select  wire:model="marca" required class="w-full">
                            <option value="">ELEGIR MARCA</option>
                            @if ($marcas->count()>0)
                            @foreach($marcas as $marca)
                            <option value="{{$marca->marca}}">{{$marca->marca}}</option>
                            @endforeach
                            @endif
                        </x-select>
                    </div>  
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="lote" value="LOTE" />
                        <x-input type="text" required wire:model="lote" required autocomplete="off" class="w-full"/>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="dosis" value="DOSIS APLICADA" />
                        <x-input type="number" required wire:model="dosis" required autocomplete="off" class=""/>
                    </div>
                    @endif
                
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                
                
                @if($registro_id!='')
                <x-button type="submit">
                    REGISTRAR VACUNACIÓN
                    <svg aria-hidden="true" class="w-3 h-3 ml-2" focusable="false" data-prefix="fal" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-plus fa-w-12 fa-3x"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z" class=""></path></svg>
                </x-button>
                <x-secondary-button type="button" wire:click.prevent="cancelar">
                    CANCELAR
                </x-secondary-button>
                @endif
            </div>
        </form>
    </x-card>
    @if($documentos!=null && 2!=2)
    <x-panel class="mt-6">
        <x-label>DOCUMENTOS DEL PACIENTE</x-label>
        @if($documentos->count()>0)
        <div class="grid grid-cols-3 md:grid-cols-5 gap-3 mt-2">
            @foreach ($documentos as $eldocumento)
              <div class="col-span-1">
                <div class="text-center">
                    <a href="{{asset('docs/'.$eldocumento->documento_nombre_1)}}" class="block" target="_blank">
                        <img src="{{asset('/images/pdf.svg')}}" class="w-10 m-auto block" alt="">
                        Doc 1
                    </a>
                </div>
              </div>
              
            @endforeach
        </div>
        @endif
    </x-panel>
    @endif
    @if($documentos_totales!=null)
    <x-panel class="mt-6">
        <x-label>DOCUMENTOS DEL PACIENTE</x-label>
        
        @if(is_array($documentos_totales) && count($documentos_totales)>0)
        <div class="grid grid-cols-3 md:grid-cols-5 gap-3 mt-2">
            @foreach ($documentos_totales as $eldocumento)
              
                 
                    
                  
                    @if(is_array($eldocumento['documentos']) && count($eldocumento['documentos'])>0)
                        <div class="col-span-1">
                        <x-label>Dosis: {{$eldocumento['dosis']}}</x-label>
                        @foreach ($eldocumento['documentos'] as $doc )
                        <div class="text-center">
                            @if($doc['documento_nombre_1']!=null)
                            <a wire:click.prevent="export('{{$doc['documento_nombre_1']}}','{{$nombres}}')" href="{{asset('docs/'.$doc['documento_nombre_1'])}}" class="block" target="_blank">
                                <img src="{{asset('/images/pdf.svg')}}" class="w-10 m-auto block" alt="">
                                Cons.
                            </a>
                            @endif
                            @if($doc['documento_nombre_2']!=null)
                            <a wire:click.prevent="export('{{$doc['documento_nombre_2']}}','{{$nombres}}','CERTIFICADO')" href="{{asset('docs/'.$doc['documento_nombre_2'])}}" class="block" target="_blank">
                                <img src="{{asset('/images/pdf.svg')}}" class="w-10 m-auto block" alt="">
                                Cert.
                            </a>
                            @endif
                            @if(count($eldocumento['documentos'])>1)
                            <x-secondary-button wire:click.prevent="eliminardocumentos({{$doc['id']}})">
                                Eliminar
                            </x-secondary-button>
                            @endif
                            <!--SI SOLO EXISTE UN DOCUMENTO NO SE DEBE ELIMIBAR, POR QUE AL GENERAR UNO NUEVO, SE CAMBIARA DE FECHA-->
                        </div>  
                        @endforeach
                    </div>
                    @endif
              
              
            @endforeach
        </div>
        @endif
    </x-panel>
    @endif
    <x-panel class="mt-6 relative">
        <x-label>PACIENTES EN TRIAJE</x-label>
        <div class="absolute right-7 top-4">
            <x-secondary-button type="button" wire:click.prevent="updateList()">
                <div wire:loading wire:target="updateList">
                    <svg aria-hidden="true" class="animate-spin w-4 h-4 mr-2" focusable="false" data-prefix="fal" data-icon="sync-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sync-alt fa-w-16 fa-3x"><path fill="currentColor" d="M457.373 9.387l-50.095 50.102C365.411 27.211 312.953 8 256 8 123.228 8 14.824 112.338 8.31 243.493 7.971 250.311 13.475 256 20.301 256h10.015c6.352 0 11.647-4.949 11.977-11.293C48.159 131.913 141.389 42 256 42c47.554 0 91.487 15.512 127.02 41.75l-53.615 53.622c-20.1 20.1-5.855 54.628 22.627 54.628H480c17.673 0 32-14.327 32-32V32.015c0-28.475-34.564-42.691-54.627-22.628zM480 160H352L480 32v128zm11.699 96h-10.014c-6.353 0-11.647 4.949-11.977 11.293C463.84 380.203 370.504 470 256 470c-47.525 0-91.468-15.509-127.016-41.757l53.612-53.616c20.099-20.1 5.855-54.627-22.627-54.627H32c-17.673 0-32 14.327-32 32v127.978c0 28.614 34.615 42.641 54.627 22.627l50.092-50.096C146.587 484.788 199.046 504 256 504c132.773 0 241.176-104.338 247.69-235.493.339-6.818-5.165-12.507-11.991-12.507zM32 480V352h128L32 480z" class=""></path></svg>
                </div>
                
                Actualizar lista
            </x-secondary-button>
        </div>
        @if($usuariosTriaje->count()>0)
        <x-table-responsive class="mt-10">
            <thead>
                <tr>
                    <x-th value="Documento" class="text-center" />
                    <x-th value="Nombres completos" class="text-left"/>
                    <x-th value="Edad" class="text-center"/>
                    <x-th value="Grupo de riesgo" class="text-left"/>
                    <x-th value="Módulo de admisión" class="text-left"/>
                    <x-th value="Acciones" class="text-center"/>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">   
                
                @foreach ($usuariosTriaje as $usuarioTriaje)
                <tr class="">
                    
                    <x-td value="{{$usuarioTriaje->documento}}" class="text-center" />
                    <x-td value="{{$usuarioTriaje->nombres}}" class="text-left" />
                    <x-td value="{{$usuarioTriaje->edad}}" class="text-center" />
                    <x-td value="{{$usuarioTriaje->grupoderiesgo}}" class="text-left" />
                    <x-td value="{{$usuarioTriaje->modulo_admision}}" class="text-center" />
                    <x-td  class="text-center w-40">
                        <div class="flex items-center justify-center">
                            <x-danger-button type="button" wire:click="autoseleccionar('{{$usuarioTriaje->documento}}')">
                                Atender
                            </x-danger-button>
                        </div>
                    </x-td>
                </tr>    
                @endforeach   
                
            </tbody>
        </x-table-responsive>
        @endif
    </x-panel>
    <x-panel class="mt-6 relative">
        <x-label>PACIENTES VACUNADOS ({{session()->get('modulo_vacunatorio')}})</x-label>
        <div class="absolute right-7 top-4">
            <x-secondary-button type="button" wire:click.prevent="updateList()">
                <div wire:loading wire:target="updateList">
                    <svg aria-hidden="true" class="animate-spin w-4 h-4 mr-2" focusable="false" data-prefix="fal" data-icon="sync-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sync-alt fa-w-16 fa-3x"><path fill="currentColor" d="M457.373 9.387l-50.095 50.102C365.411 27.211 312.953 8 256 8 123.228 8 14.824 112.338 8.31 243.493 7.971 250.311 13.475 256 20.301 256h10.015c6.352 0 11.647-4.949 11.977-11.293C48.159 131.913 141.389 42 256 42c47.554 0 91.487 15.512 127.02 41.75l-53.615 53.622c-20.1 20.1-5.855 54.628 22.627 54.628H480c17.673 0 32-14.327 32-32V32.015c0-28.475-34.564-42.691-54.627-22.628zM480 160H352L480 32v128zm11.699 96h-10.014c-6.353 0-11.647 4.949-11.977 11.293C463.84 380.203 370.504 470 256 470c-47.525 0-91.468-15.509-127.016-41.757l53.612-53.616c20.099-20.1 5.855-54.627-22.627-54.627H32c-17.673 0-32 14.327-32 32v127.978c0 28.614 34.615 42.641 54.627 22.627l50.092-50.096C146.587 484.788 199.046 504 256 504c132.773 0 241.176-104.338 247.69-235.493.339-6.818-5.165-12.507-11.991-12.507zM32 480V352h128L32 480z" class=""></path></svg>
                </div>
                
                Actualizar lista
            </x-secondary-button>
        </div>
        @if($usuariosVacunados->count()>0)
        <x-table-responsive class="mt-10">
            <thead>
                <tr>
                    <x-th value="Nombres completos" class="text-left"/>
                    <x-th value="Licenciado(a)" class="text-left"/>
                    <x-th value="Marca de vacuna" class="text-left"/>
                    <x-th value="Lote" class="text-center"/>
                    <x-th value="Dosis" class="text-center"/>
                    <x-th value="Archivos" class="text-center"/>
                    <x-th value="Acciones" class="text-center"/>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">   
                
                @foreach ($usuariosVacunados as $usuarioVacunado)
                <tr class="">
                    
                    <x-td class="text-left">
                        <x-label>{{$usuarioVacunado->documento}}</x-label>
                        {{$usuarioVacunado->nombres}}
                        <small class="text-sm"> ({{$usuarioVacunado->edad}})</small>
                        
                    </x-td>
                    <x-td value="{{$usuarioVacunado->licenciado}}" class="text-left" />
                    <x-td value="{{$usuarioVacunado->marca}}" class="text-left" />
                    <x-td value="{{$usuarioVacunado->lote}}" class="text-center" />
                    <x-td value="{{$usuarioVacunado->dosis}}" class="text-center" />
                    <x-td>
                        @if($usuarioVacunado->documentos->count()>0)
                        @php
                            $total_documentos = $usuarioVacunado->documentos->count();
                        @endphp
                        <div class="gap-2 grid grid-cols-2">
                            @foreach ($usuarioVacunado->documentos as $docs)
                                <div class="col-span-1">
                                    <div class="text-center">
                                        <a wire:click.prevent="export('{{$docs->documento_nombre_1}}','{{$usuarioVacunado->nombres}}')" href="{{asset('docs/'.$docs->documento_nombre_1)}}" class="block" target="_blank">
                                            <img src="{{asset('/images/pdf.svg')}}" class="w-10 m-auto block" alt="">
                                            Consentimiento
                                        </a>
                                    </div>
                                </div>  
                                <div class="col-span-1">
                                    <div class="text-center">
                                        <a wire:click.prevent="export('{{$docs->documento_nombre_2}}','{{$usuarioVacunado->nombres}}','CERTIFICADO')" href="{{asset('docs/'.$docs->documento_nombre_2)}}" class="block" target="_blank">
                                            <img src="{{asset('/images/pdf.svg')}}" class="w-10 m-auto block" alt="">
                                            Certificado
                                        </a>
                                        @php
                                            $linkw = 'https://api.whatsapp.com/send?';
                                            if($dispositivo == 'desktop'){
                                                $linkw = 'https://web.whatsapp.com/send?';
                                            }

                                            $enlacew = '';

                                            if(strlen($usuarioVacunado->telefono)==9){
                                                $enlacew = 'phone=51' . $usuarioVacunado->telefono . '&';
                                            }

                                            $linkw = $linkw . $enlacew . 'text=Certificado de vacunación ' . asset('docs/'.$docs->documento_nombre_2);

                                        @endphp
                                        <a  target="_blank" href="{{$linkw}}"  data-action="share/whatsapp/share" class="bg-green-600 mt-3 text-white hover:bg-green-700 focus:border-green-800 focus:ring-green-300 inline-flex items-center p-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none focus:ring  disabled:opacity-25 transition">
                                            <svg aria-hidden="true" class="w-6 h-6" focusable="false" data-prefix="fab" data-icon="whatsapp" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-whatsapp fa-w-14 fa-3x"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" class=""></path></svg>
                                            
                                        </a>
                                    </div>
                                </div> 
                                @if($total_documentos>1)
                                <div class="col-span-2 text-center">
                                    <x-secondary-button wire:click.prevent="eliminardocumentos({{$docs->id}})">
                                        Eliminar
                                    </x-secondary-button>
                                </div> 
                                @endif
                            @endforeach
                        </div>
                        @endif
                    </x-td>
                    <x-td  class="text-center w-40">
                        <div class="">
                            <x-button-pink type="button" class="whitespace-nowrap" wire:click="autoseleccionar('{{$usuarioVacunado->documento}}',{{$usuarioVacunado->id}})">
                                <svg aria-hidden="true" class="w-5 h-5 mr-2" focusable="false" data-prefix="fal" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-edit fa-w-18 fa-3x"><path fill="currentColor" d="M417.8 315.5l20-20c3.8-3.8 10.2-1.1 10.2 4.2V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h292.3c5.3 0 8 6.5 4.2 10.2l-20 20c-1.1 1.1-2.7 1.8-4.2 1.8H48c-8.8 0-16 7.2-16 16v352c0 8.8 7.2 16 16 16h352c8.8 0 16-7.2 16-16V319.7c0-1.6.6-3.1 1.8-4.2zm145.9-191.2L251.2 436.8l-99.9 11.1c-13.4 1.5-24.7-9.8-23.2-23.2l11.1-99.9L451.7 12.3c16.4-16.4 43-16.4 59.4 0l52.6 52.6c16.4 16.4 16.4 43 0 59.4zm-93.6 48.4L403.4 106 169.8 339.5l-8.3 75.1 75.1-8.3 233.5-233.6zm71-85.2l-52.6-52.6c-3.8-3.8-10.2-4-14.1 0L426 83.3l66.7 66.7 48.4-48.4c3.9-3.8 3.9-10.2 0-14.1z" class=""></path></svg>
                                Modificar
                            </x-button-pink>
                            

                        </div>
                    </x-td>
                </tr>    
                @endforeach   
                
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="100%">
                       <div class="p-10">
                            {{$usuariosVacunados->links()}}
                        </div> 
                    </th>
                </tr>
            </tfoot>
        </x-table-responsive>
        @endif
    </x-panel>
    <div class="max-w-7xl mx-auto mt-6">
        <div class="bg-indigo-700 overflow-hidden shadow-xl sm:rounded-lg p-3">
            <div class="w-full flex justify-between items-center">
                <p class="uppercase text-white">Estás trabajando con: {{session()->get('vacunador_nombre')}}</p>
                <x-secondary-button wire:click.prevent="liberar">
                    Liberar  especialista
                </x-secondary-button>
            </div>
        </div>
    </div>
</div>
