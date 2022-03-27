<div>
   
    @include('snippets.consentimiento')
    @include('snippets.consentimiento14a')
    @include('snippets.consentimiento14b')
    @include('snippets.consentimientoChild')
    @include('snippets.consentimientoTercero')
    @include('snippets.consentimiento1ra2da18mas')

    @include('snippets.consentimientoSino')

    <x-confirmation-modal wire:model="askDoc">
        <x-slot name="title">
            Notificación
        </x-slot>
        <x-slot name="content">
            Desea generar el consentimiento informado?
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button type="button" wire:click.pevent="$toggle('askDoc')" wire:loading.attr="disabled">
                NO
            </x-secondary-button>
            <x-button type="button" wire:click.pevent="mostrarElConsentimiento" wire:loading.attr="disabled">
                SI
            </x-button>
        </x-slot>
    </x-confirmation-modal>
    <x-confirmation-modal wire:model="askadvertencia">
        <x-slot name="title">
            Notificación
        </x-slot>
        <x-slot name="content">
            <p class="text-left">
                Para poder generar el consentimiento asegurate de haber guardado la dirección del paciente y haber elegido la marca de la vacuna
            </p>
            
        </x-slot>
        <x-slot name="footer">
            <x-button type="button" wire:click.pevent="$toggle('askadvertencia')" wire:loading.attr="disabled">
                OK
            </x-button>
        </x-slot>
    </x-confirmation-modal>
    <x-card>
        <x-banner />
        <form action="#" id="registroform" method="POST" wire:submit.prevent="store()">
                   
            <input type="hidden" name="registro_id" value="{{$registro_id}}">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-10 gap-3">
                    
                    <div class="col-span-10 sm:col-span-2 lg:col-span-2">
                        
                        <x-label for="tipodocumento" value="TIPO DE DOC." />
                        <x-select  wire:model="tipodocumento" class="w-full">
                            @foreach($tipodocumentos as $indexDoc => $textDoc)
                            <option value="{{$indexDoc}}">{{$textDoc}}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="col-span-10 sm:col-span-4 lg:col-span-2">
                        <x-label for="documento" value="DOCUMENTO" />
                        <div class="relative">
                            <x-input type="text" wire:model="documento" required autocomplete="off" class="w-full"/>
                            <x-button type="button" wire:click.prevent="buscarDeAdmision()" class="absolute right-1 top-2">
                                <svg aria-hidden="true" class="w-4 h-4" focusable="false" data-prefix="fal" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-search fa-w-16 fa-3x"><path fill="currentColor" d="M508.5 481.6l-129-129c-2.3-2.3-5.3-3.5-8.5-3.5h-10.3C395 312 416 262.5 416 208 416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c54.5 0 104-21 141.1-55.2V371c0 3.2 1.3 6.2 3.5 8.5l129 129c4.7 4.7 12.3 4.7 17 0l9.9-9.9c4.7-4.7 4.7-12.3 0-17zM208 384c-97.3 0-176-78.7-176-176S110.7 32 208 32s176 78.7 176 176-78.7 176-176 176z" class=""></path></svg>
                            </x-button>
                        </div>
                        <p>{{$message_search}}</p>
                        <div wire:loading wire:target="buscarDeAdmision">
                            Buscando...
                        </div>
                    </div>

                    <div class="col-span-10 sm:col-span-4 lg:col-span-2">
                        <x-label for="nombres" value="NOMBRES Y APELLIDOS" />
                        <x-input type="text" wire:model="nombres" disabled autocomplete="off" class="w-full bg-gray-200 cursor-not-allowed"/>
                    </div>

    
                    <div class="col-span-10 sm:col-span-3 lg:col-span-2">
                        <x-label for="fechanacimiento" value="FECHA DE NACIMIENTO" />
                        <x-input type="text" wire:model.debounce.1000ms="fechanacimiento" placeholder="dd-mm-yyyy" disabled autocomplete="off" class="w-full bg-gray-200 cursor-not-allowed"/>
                    </div>

                    <div class="col-span-10 sm:col-span-3 lg:col-span-2">
                        <x-label for="edad" value="EDAD" />
                        <x-input type="text" wire:model="edad" disabled autocomplete="off" class="w-full bg-gray-200 cursor-not-allowed"/>
                    </div>

                    <div class="col-span-10 sm:col-span-4 lg:col-span-2">
                        <x-label for="telefono" value="TELEFONO" />
                        <x-input type="text" wire:model="telefono" disabled autocomplete="off" class="w-full bg-gray-200 cursor-not-allowed"/>
                    </div>

                    <div class="col-span-10 sm:col-span-5 lg:col-span-4">
                        <x-label for="domicilio" value="DIRECCIÓN" />
                        <x-input type="text" wire:model="domicilio" disabled autocomplete="off" class="w-full bg-gray-200 cursor-not-allowed"/>
                    </div>

                    

                    <div class="col-span-10 sm:col-span-5 lg:col-span-4">
                        <x-label for="grupoderiesgo" value="GRUPO DE RIESGO" />
                        <div class="relative" x-data="{ open: false }">
                            <x-select wire:model="grupoderiesgo"  disabled class="w-full  bg-gray-200 cursor-not-allowed">
                                
                                @if($riesgos->count()>0)
                                    @foreach ($riesgos as $riesgo)
                                        <option value="{{$riesgo->riesgo}}">{{$riesgo->riesgo}}</option>
                                    @endforeach
                                @endif
                            </x-select>
                        </div>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        <x-label for="dosis" value="DOSIS" />
                        <x-select wire:model.defer="dosis" wire:change="calcularConsentimiento" required class="w-full">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </x-select>
                    </div>
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2">
                        
                        <x-label for="marca" value="MARCA DE LA VACUNA" />
                        <x-select  wire:model="marca" required class="w-full">
                            <option value="">ELEGIR MARCA</option>
                            @if ($marcas->count()>0)
                            @foreach($marcas as $marcah)
                            <option value="{{$marcah->marca}}">{{$marcah->marca}}</option>
                            @endforeach
                            @endif
                        </x-select>
                    </div>  
                    <div class="col-span-8 sm:col-span-4 lg:col-span-4">
                        
                        <x-label for="opt_consentimiento" value="TIPO DE CONSENTIMIENTO" />
                        <x-select  wire:model="opt_consentimiento" required class="w-full">
                            <option value="">ELEGIR</option>
                            <option value="3ra18mas">3ra dosis de 18 a más</option>
                            <option value="1ra2da18mas">1ra y 2da dosis de 18 a más</option>
                            <!--<option value="1217">12-17 años</option>
                            <option value="511">5-11 años</option>-->
                        </x-select>
                    </div>  
                    
                    <div class="col-span-8 sm:col-span-4 lg:col-span-2 hidden">
                        
                        <div class="flex">
                            <input type="checkbox" wire:model="estado_edad" name="estado_edad" id="estado_edad">
                           
                            <x-label for="estado_edad"  class="ml-3" value="Niño o adolescente" />
                        </div>
                       
                        
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                
                @if($registro_id!=null)
                @if($poderGenerarConsentimiento==true)
                <x-secondary-button type="button" wire:click.pevent="$toggle('askDoc')" wire:loading.attr="disabled">
                    GENERAR CONSENTIMIENTO
                    <svg aria-hidden="true" class="w-5 h-5 mr-2" focusable="false" data-prefix="fas" data-icon="file-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-file-alt fa-w-12 fa-3x"><path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm64 236c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-64c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-72v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm96-114.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z" class=""></path></svg>
                </x-secondary-button>   
                @else
                <x-secondary-button type="button" wire:click.pevent="$toggle('askadvertencia')" wire:loading.attr="disabled">
                    GENERAR CONSENTIMIENTO
                    <svg aria-hidden="true" class="w-5 h-5 mr-2" focusable="false" data-prefix="fas" data-icon="file-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-file-alt fa-w-12 fa-3x"><path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm64 236c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-64c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12v8zm0-72v8c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-8c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm96-114.1v6.1H256V0h6.1c6.4 0 12.5 2.5 17 7l97.9 98c4.5 4.5 7 10.6 7 16.9z" class=""></path></svg>
                </x-secondary-button> 
                @endif
<!--
                <x-secondary-button type="button" wire:click.pevent="openModalCompanion()">
                    AGREGAR ACOMPAÑANTE
                    <svg aria-hidden="true" class="w-5 h-5 ml-2" focusable="false" data-prefix="fal" data-icon="user-plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-user-plus fa-w-20 fa-3x"><path fill="currentColor" d="M632 224h-88v-88c0-4.4-3.6-8-8-8h-16c-4.4 0-8 3.6-8 8v88h-88c-4.4 0-8 3.6-8 8v16c0 4.4 3.6 8 8 8h88v88c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-88h88c4.4 0 8-3.6 8-8v-16c0-4.4-3.6-8-8-8zm-318.4 64c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4zM416 464c0 8.8-7.2 16-16 16H48c-8.8 0-16-7.2-16-16v-41.6C32 365.9 77.9 320 134.4 320c19.6 0 39.1 16 89.6 16 50.4 0 70-16 89.6-16 56.5 0 102.4 45.9 102.4 102.4V464zM224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm0-224c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z" class=""></path></svg>
                </x-secondary-button>-->
               <!-- <x-button type="submit">
                    ACTUALIZAR
                    <svg aria-hidden="true" class="w-5 h-5 ml-2" focusable="false" data-prefix="fal" data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-plus fa-w-12 fa-3x"><path fill="currentColor" d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z" class=""></path></svg>
                </x-button>
            -->

                @endif
            </div>
        </form>
    </x-card>
    <!--$-documentos-Antes se utilizaba el siguiente codigo-->
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
                    <x-secondary-button wire:click.prevent="eliminardocumentos({{$eldocumento->id}})">
                        Eliminar
                    </x-secondary-button>
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
        <x-label>PACIENTES EN ADMISIÓN</x-label>
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
                    <x-th value="Adjuntos" class="text-center"/>
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
                    <x-td class="text-center">
                        @if($usuarioTriaje->archivos_adjuntos->count()>0)
                        <div style="max-width:166px">
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($usuarioTriaje->archivos_adjuntos as $adjunto)
                                <div class="col-span-1">
                                    <a rel="example_group{{$usuarioTriaje->id}}" href="{{asset('/firmas/' . $adjunto->nombrearchivo)}}" title="" class="bg-gray-800 flex items-center justify-center" style="height: 100px">
                                        <img src="{{asset('/firmas/' . $adjunto->nombrearchivo)}}" class="w-full object-cover" style="max-height: 100px">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </x-td>
                    <x-td  class="text-center w-40">
                        <div class="flex items-center justify-center">
                            <x-danger-button type="button" wire:click="autoseleccionar('{{$usuarioTriaje->documento}}',{{$usuarioTriaje->id}})">
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
    
    <script>
        //
        
        
        document.addEventListener('livewire:load', function () {
            
            var sigdiv1 = null;
            var sigdiv2 = null;
            var sigdiv3 = null;
            var sigdiv4 = null;
            var sigdiv5 = null;

            var sigdiv7 = null;
            var sigdiv8 = null;

            var sigdiv9 = null;
            var sigdiv10 = null;

            var sigdiv1ra2da18mas1 = null;
            var sigdiv1ra2da18mas2 = null;
            
            $(document).ready(function() {
                
                $(document).on('click','#signature1',function(e){
                    e.preventDefault();

                    var firmaDocumento1 = $(sigdiv1).jSignature('getData', 'image');
                    var firmaDocumento2 = $(sigdiv2).jSignature('getData', 'image');

                    Livewire.emit('guardarFirma',firmaDocumento1[1],firmaDocumento2[1]);
                
                });
                $(document).on('click','#signature3',function(e){
                    e.preventDefault();

                    //var firmaDocumento3 = $(sigdiv3).jSignature('getData', 'image');
                    $('.loading-docs').removeClass('hidden');
                    Livewire.emit('guardarFirma2');
                
                });
                $(document).on('click','#signature4',function(e){
                    e.preventDefault();
                    $('.loading-docs').removeClass('hidden');
                    $(this).attr('disabled',true);
                    var firmaDocumento4 = $(sigdiv4).jSignature('getData', 'image');
                    var firmaDocumento5 = $(sigdiv5).jSignature('getData', 'image');

                    Livewire.emit('guardarFirma4',firmaDocumento4[1],firmaDocumento5[1]);
                
                });
                
                //actualizacion child
                $(document).on('click','#signaturechild',function(e){
                    e.preventDefault();
                    $('.loading-docs').removeClass('hidden');
                    $(this).attr('disabled',true);
                    var firmaDocumento9 = $(sigdiv9).jSignature('getData', 'image');
                    var firmaDocumento10 = $(sigdiv10).jSignature('getData', 'image');

                    Livewire.emit('guardarFirmaChild',firmaDocumento9[1],firmaDocumento10[1]);
                
                });
                //actualizacion para la tercera dosis
                $(document).on('click','#signatureTercera',function(e){
                    e.preventDefault();
                    $('.loading-docs').removeClass('hidden');
                    $(this).attr('disabled',true);
                    var firmaDocumento7 = $(sigdiv7).jSignature('getData', 'image');
                    var firmaDocumento8 = $(sigdiv8).jSignature('getData', 'image');

                    Livewire.emit('guardarFirmaTercera',firmaDocumento7[1],firmaDocumento8[1]);
                
                });
                $(document).on('click','#signature1ra2da18mas',function(e){
                    e.preventDefault();
                    $('.loading-docs').removeClass('hidden');
                    $(this).attr('disabled',true);
                    var firma1ra2da18mas1 = $(sigdiv1ra2da18mas1).jSignature('getData', 'image');
                    var firma1ra2da18mas2 = $(sigdiv1ra2da18mas2).jSignature('getData', 'image');

                    Livewire.emit('guardarFirma1ra2da18mas',firma1ra2da18mas1[1],firma1ra2da18mas2[1]);
                
                });
            });
          
            window.livewire.on('generar-firma', iddoc => {
                $(document).ready(function() {
                   
                    $('.firmap').addClass('opacity-0');
                    $('.firmap'+iddoc).removeClass('opacity-0');
                    sigdiv1 = $("#signaturesign1").jSignature({'UndoButton':true,color:"#000",lineWidth:1});
                    sigdiv2 = $("#signaturesign2").jSignature({'UndoButton':true,color:"#000",lineWidth:1});

                });
            });

            window.livewire.on('generar-firma-child', iddoc => {
                $(document).ready(function() {
                   
                    $('.firmap').addClass('opacity-0');
                    $('.firmap'+iddoc).removeClass('opacity-0');
                    sigdiv9 = $("#signaturesign9").jSignature({'UndoButton':true,color:"#000",lineWidth:1});
                    sigdiv10 = $("#signaturesign10").jSignature({'UndoButton':true,color:"#000",lineWidth:1});

                });
            });

            window.livewire.on('generar-firma-sin', iddoc => {
                $(document).ready(function() {
                
                    $('.firmap').addClass('opacity-0');
                    $('.firmap'+iddoc).removeClass('opacity-0');
                    sigdiv4 = $("#signaturesign4").jSignature({'UndoButton':true,color:"#000",lineWidth:1});
                    sigdiv5 = $("#signaturesign5").jSignature({'UndoButton':true,color:"#000",lineWidth:1});
                   
                });
            });
            window.livewire.on('generar-firma-tres', iddoc => {
                $(document).ready(function() {
                
                    $('.firmap').addClass('opacity-0');
                    $('.firmap'+iddoc).removeClass('opacity-0');
                    sigdiv7 = $("#signaturesign7").jSignature({'UndoButton':true,color:"#000",lineWidth:1});
                    sigdiv8 = $("#signaturesign8").jSignature({'UndoButton':true,color:"#000",lineWidth:1});
                    
                });
            });
            window.livewire.on('generar-firma-1ra2da18mas', iddoc => {
                $(document).ready(function() {
                
                    $('.firmap').addClass('opacity-0');
                    $('.firmap'+iddoc).removeClass('opacity-0');
                    sigdiv1ra2da18mas1 = $("#signaturesign1ra2da18mas1").jSignature({'UndoButton':true,color:"#000",lineWidth:1});
                    sigdiv1ra2da18mas2 = $("#signaturesign1ra2da18mas2").jSignature({'UndoButton':true,color:"#000",lineWidth:1});
                    
                });
            });
            window.livewire.on('generar-firma-final', iddoc => {
                $(document).ready(function() {

                    sigdiv3 = $("#signaturesign3").jSignature({'UndoButton':true,color:"#000",lineWidth:1});

                });
            });
            
        });
    </script>
</div>
