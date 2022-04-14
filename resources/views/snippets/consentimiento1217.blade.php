<?php
    $nombre_sp = mb_strtoupper($nombres);
    $spaces = 40 - strlen($nombre_sp);
    
    if($spaces<0){
        $spaces = 0;
    }
    
    $nombre_puntos = str_repeat('<span class="sp">&nbsp;</span>',$spaces);
    
    $nombre_completo = $nombre_sp . $nombre_puntos;

    /*DIA*/
    $campo_dia = str_pad(date('d'),2,'0',STR_PAD_RIGHT);
    $cantidad_adicional_dia = str_repeat('<span class="sp">&nbsp;</span>',2);
    $campo_dia=$cantidad_adicional_dia . $campo_dia . $cantidad_adicional_dia;

    /*MES*/
    $meses = [
        '01'=>'enero','02'=>'febrero','03'=>'marzo','04'=>'abril',
        '05'=>'mayo','06'=>'junio','07'=>'julio','08'=>'agosto',
        '09'=>'septiembre','10'=>'octubre','11'=>'noviembre','12'=>'diciembre'
    ];
    
    $campo_meses = $meses[date('m')];
    $espacio_meses = 15 - strlen($campo_meses);
    if($espacio_meses%2!=0){
        $espacio_meses++;
    }
    $totalporlado_meses = $espacio_meses / 2;
    $cantidad_adicional_meses = str_repeat('<span class="sp">&nbsp;</span>',$totalporlado_meses);
    $campo_meses=$cantidad_adicional_meses . $campo_meses . $cantidad_adicional_meses;



    $campo_documento = mb_strtoupper($documento);
    $espacio_documento = 12 - strlen($campo_documento);
    if($espacio_documento%2!=0){
        $espacio_documento++;
    }
    $totalporlado_documento = $espacio_documento / 2;
    $cantidad_adicional_documento = str_repeat('<span class="sp">&nbsp;</span>',$totalporlado_documento);
    $campo_documento=$cantidad_adicional_documento . $campo_documento . $cantidad_adicional_documento;

    $campo_documento_triaje = mb_strtoupper(Auth::user()->dni);
    $espacio_documento_triaje = 12 - strlen($campo_documento_triaje);
    if($espacio_documento%2!=0){
        $espacio_documento_triaje++;
    }
    $totalporlado_documento_triaje = $espacio_documento_triaje / 2;
    $cantidad_adicional_documento_triaje = str_repeat('<span class="sp">&nbsp;</span>',$totalporlado_documento_triaje);
    $campo_documento_triaje=$cantidad_adicional_documento_triaje . $campo_documento_triaje . $cantidad_adicional_documento_triaje;


    $campo_documento_child = mb_strtoupper($documento);
    $espacio_documento_child = 12 - strlen($campo_documento_child);
    if($espacio_documento_child%2!=0){
        $espacio_documento_child++;
    }
    $totalporlado_documento_child = $espacio_documento_child / 2;
    $cantidad_adicional_documento_child = str_repeat('<span class="sp">&nbsp;</span>',$totalporlado_documento_child);
    $campo_documento_child=$cantidad_adicional_documento_child . $campo_documento_child . $cantidad_adicional_documento_child;



    /*HORA*/
    $campo_hora = date('h:i A');
    $espacio_hora = 12 - strlen($campo_hora);
    
    if($espacio_hora%2!=0){
        $espacio_hora++;
    }
    $totalporlado_hora=$espacio_hora/2;

    $cantidad_adicional_hora = str_repeat('<span class="sp">&nbsp;</span>',$totalporlado_hora);

    $campo_hora=$cantidad_adicional_hora . $campo_hora . $cantidad_adicional_hora;

    $mamacondni = $companion_nombres . ' con DNI: ' . $companion_documento;
    $hijo = mb_strtoupper($nombres);
    

?>
@include('snippets.css')
    
    <x-form-modal submit="procesar1217" wire:model="mostrarconsentimiento1217" maxWidth="max-tablet">
        <x-slot name="title"></x-slot>
    
        
        
        <x-slot name="content">
          
            <div class="px-2 md:px-5 lg:px-5 mt-5">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <img src="{{asset('images/logo-essalud.png')}}" class="h-8 mb-2" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <p class="title" style="font-size: 11px">PROTOCOLO PARA LA VACUNACIÓN CONTRA LA COVID-19 PARA ADOLECENTES DE 12 A 17 AÑOS DE EDAD.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="title">ANEXO N°01</p>
                                <p class="title">EXPRESIÓN DE CONSENTIMIENTO <b>INFORMADO</b></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="w-full">
                                    <tr>
                                        <td>
                                            <p>Fecha: <span class="understroke">{!!$campo_dia!!}</span> de 
                                                <span class="understroke">{!!$campo_meses!!}</span> del {{date('Y')}}</p>
                                        </td>
                                        <td>
                                            <p class="text-right">Hora: <span class="understroke">{!!$campo_hora!!}</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="flex items-center">
                                                <span class="mr-2">
                                                    Yo,
                                                </span>
                                                <div class="understroke" style="width: 498px; height:23px; position: relative">
                                                    {!!$mamacondni!!}
                                                </div>
                                                <span class="ml-2">, declaro lo Siguiente:</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="flex items-center">
                                                <span class="ml-2"> Que </span>
                                                <div class="understroke" style="width: 334px; height:23px; position: relative">
                                                    {!!$hijo!!}
                                                </div>
                                                <span class="ml-2"> con DNI: </span>
                                                <div class="understroke" style="width: 98px; height:23px; position: relative">
                                                    {!!$campo_documento_child!!}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                   
                                </table>
                                
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="mt-3 text-justify"> 
                                    SI (<span><input type="radio" required wire:model.defer="child_documento2_pre1" name="doc2pre1" value="SI"></span>) 
                                    NO (<span><input type="radio" required wire:model.defer="child_documento2_pre1" name="doc2pre1" value="NO"></span>) tiene síntomas compatibles con COVID-19; o ha dado positivo a una prueba a COVID-19, en las últimas dos semanas; o estoy en seguimiento clínico por COVID-19.
                                </p>
                                <p class="text-justify">
                                    SI (<span><input type="radio" required wire:model.defer="child_documento2_pre2" name="doc2pre2" value="SI"></span>) 
                                    NO (<span><input type="radio" required wire:model.defer="child_documento2_pre2" name="doc2pre2" value="NO"></span>) tiene contacto con alguien que dio positivo  a  la COVID-19, en las últimas dos semanas ; o estuvo en cuarentena.
                                </p>
                                <p class="text-justify">
                                    En ese sentido, he sido informado (a) de los beneficios y Ios potenciales efectos adversos de la Vacuna contra la COVID-19 y, resueltas todas las preguntas y dudas al respecto, consciente de mis derechos y en forma voluntaria, en cumplimiento de la normativa vigente; 

                                    SI (<span><input type="radio" required wire:model.defer="child_documento2_pre3" name="doc2pre3" value="SI"></span>) 
                                    NO (<span><input type="radio" required wire:model.defer="child_documento2_pre3" name="doc2pre3" value="NO"></span>) doy mi consentimiento para que el personal de salud me aplique la vacuna contra el COVID-19.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="w-full">
                                    <tr>
                                        <td width="55%">
                                            <div class="firma firmap firmap1" style="min-height: 5rem">
                                                <div id="signatureparent">
                                                    <div id="signaturesign12171" style="max-width:298px;background: #efefef;"></div>
                                                </div>
                                                <div id="tools"></div>
                                            </div>
                                            <p class="sub">Firma o huella digital del padre/madre, tutor, o familiar mayor de edad
                                                </p>
                                            <p class="mt-3">DNI N° <span class="understroke"><span class="firmap firmap1">{!!$campo_documento!!}</span></span></p>
                                        </td>
                                        <td width="45%">
                                            <div class="firma relative" style="min-height: 5rem">
                                                @if ($firmartraije=='consentimiento')
                                                    <img src="{{asset('firmas/'.Auth::user()->firma)}}" class="h-20 m-auto" alt="">
                                                @endif
                                                <input type="radio" wire:model="firmartraije" wire:change="getdoclafirma('generar-firma-1217','1')" name="firmartraije" class="absolute right-0 top-10" value="consentimiento">
                                            </div>
                                            <p class="sub withline">Firma y sello del personal de salud que informa y toma el consentimiento</p>
                                            <p class="mt-3">DNI N° <span class="understroke"><span class="firmap firmap1">{!!$campo_documento_triaje!!}</span></span></p>
                                        </td>
                                    </tr>
                                </table>
                                
                            </td>
                        </tr>
                        <tr>
                            <td><p class="title-spacer">REVOCATORIA / DESISTIMIENTO DEL CONSENTIMIENTO:</p></td>
                        </tr>
                        <tr>
                            <td>
                                <table class="w-full">
                                    <tr>
                                        <td colspan="2" class="">
                                            <table>
                                                <tr>
                                                    <td width="60%">
                                                        <p>Fecha: <span class="understroke"><span class="firmap firmap2">{!!$campo_dia!!}</span></span> de 
                                                            <span class="understroke"><span class="firmap firmap2">{!!$campo_meses!!}</span></span> del {{date('Y')}}</p>
                                                    </td>
                                                    <td width="40%">
                                                        <p class="text-right">Hora: <span class="understroke"><span class="firmap firmap2">{!!$campo_hora!!}</span></span></p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="55%">
                                            <div class="firma firmap firmap2" style="min-height: 5rem">
                                                <div id="signatureparent">
                                                    <div id="signaturesign12172" style="max-width:298px;background: #efefef;"></div>
                                                </div>
                                                <div id="tools"></div>
                                            </div>
                                            <p class="sub">Firma o huella digital del padre/madre, tutor, o familiar mayor de edad
                                                </p>
                                            <p class="mt-3">DNI N° <span class="understroke"><span class="firmap firmap2">{!!$campo_documento!!}</span></span></p>
                                        </td>
                                        <td width="45%">
                                            <div class="firma relative" style="min-height: 5rem">
                                                @if ($firmartraije=='desistimiento')
                                                    <img src="{{asset('firmas/'.Auth::user()->firma)}}" class="h-20 m-auto" alt="">
                                                @endif
                                                <input type="radio" wire:model="firmartraije" wire:change="getdoclafirma('generar-firma-1217','2')" name="firmartraije" class="absolute right-0 top-10" value="desistimiento">
                                            </div>
                                            <p class="sub withline">Firma y sello del personal de salud que informa y toma la revocatoria</p>
                                            <p class="mt-3">DNI N° <span class="understroke"><span class="firmap firmap2">{!!$campo_documento_triaje!!}</span></span></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-secondary-button type="button" wire:click.pevent="$toggle('mostrarconsentimiento1217')" wire:loading.attr="disabled">
                CANCELAR
            </x-secondary-button>
            <x-button type="button" id="signature1217">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white loading-docs hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>  PROCESAR DOCUMENTOS
            </x-button>
        </x-slot>
    </x-form-modal>
    