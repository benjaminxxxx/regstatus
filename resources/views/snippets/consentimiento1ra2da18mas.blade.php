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
    $parientede = $companion_tipo . ' DEL MENOR ' . mb_strtoupper($nombres);
    

?>
@include('snippets.css')
    
    <x-form-modal submit="procesar1ra2da18mas" wire:model="mostrarconsentimiento1ra2da18mas" maxWidth="max-tablet">
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
                                <p class="title" style="font-size: 11px">“Manual de Vacunación Segura contra la COVID-19 en el Seguro Social de Salud- EsSaLUD-V.T”</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="title">ANEXO N" 5-A</p>
                                <p class="title">EXPRESIÓN DE CONSENTIMIENTO INFORMADO <sup style="font-size: 8px">55</sup></p>
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
                                                <div class="understroke" style="width: 323px; height:23px; position: relative">
                                                    {{$nombre_sp}}
                                                </div>
                                                <span class="ml-2"> con DNI: </span>
                                                <div class="understroke" style="width: 98px; height:23px; position: relative">
                                                    {!!$campo_documento!!}
                                                </div>
                                                <span class="ml-2">
                                                    declaro lo siguiente:
                                                </span>
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
                                    NO (<span><input type="radio" required wire:model.defer="child_documento2_pre1" name="doc2pre1" value="NO"></span>) tengo síntomas compatibles con COVID-19; o he dado positivo a una prueba    COVID-19, en las últimas dos semanas; o estoy en seguimiento clínico por COVID-19.
                                </p>
                                <p class="text-justify">
                                    SI (<span><input type="radio" required wire:model.defer="child_documento2_pre2" name="doc2pre2" value="SI"></span>) 
                                    NO (<span><input type="radio" required wire:model.defer="child_documento2_pre2" name="doc2pre2" value="NO"></span>) he tenido contacto con alguien que dio positivo  a  la COVID-19, en las últimas dos semanas ; o estoy en cuarentena.
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
                                                    <div id="signaturesign1ra2da18mas1" style="max-width:298px;background: #efefef;"></div>
                                                </div>
                                                <div id="tools"></div>
                                            </div>
                                            <p class="sub">Firma o huelle digital del paciente, padre/madre*
                                                o apoderado
                                                </p>
                                            <p class="mt-3">DNI N° <span class="understroke"><span class="firmap firmap1">{!!$campo_documento!!}</span></span></p>
                                        </td>
                                        <td width="45%">
                                            <div class="firma relative" style="min-height: 5rem">
                                                @if ($firmartraije=='consentimiento')
                                                    <img src="{{asset('firmas/'.Auth::user()->firma)}}" class="h-20 m-auto" alt="">
                                                @endif
                                                <input type="radio" wire:model="firmartraije" wire:change="getdoclafirma('generar-firma-1ra2da18mas','1')" name="firmartraije" class="absolute right-0 top-10" value="consentimiento">
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
                                                    <div id="signaturesign1ra2da18mas2" style="max-width:298px;background: #efefef;"></div>
                                                </div>
                                                <div id="tools"></div>
                                            </div>
                                            <p class="sub">Firma o huella digital del paciente, padre/madre*
                                                o apoderado
                                                </p>
                                            <p class="mt-3">DNI N° <span class="understroke"><span class="firmap firmap2">{!!$campo_documento!!}</span></span></p>
                                        </td>
                                        <td width="45%">
                                            <div class="firma relative" style="min-height: 5rem">
                                                @if ($firmartraije=='desistimiento')
                                                    <img src="{{asset('firmas/'.Auth::user()->firma)}}" class="h-20 m-auto" alt="">
                                                @endif
                                                <input type="radio" wire:model="firmartraije" wire:change="getdoclafirma('generar-firma-1ra2da18mas','2')" name="firmartraije" class="absolute right-0 top-10" value="desistimiento">
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
                                <p class="title" style="font-size: 11px">“Manual de Vacunación Segura contra la COVID-19 en el Seguro Social de Salud - EsSaLUD-V.T”</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="title">ANEXO N° 5-B</p>
                                <p class="title">HOJA INFORMATIVA SOBRE LA VACUNA CONTRA LA COVID-19</p>
                            </td>
                        </tr>
                        <tr>
                            <td  colspan="2">
                                <p class="text-justify">
                                    La pandemia ocasionada por la COVID-19 ha producido hasta el momento, más de 113 m millones de casos y más de 2,5 millones de muertes a lo largo de todo el mundo. La COVID-19 es la enfermedad producida por un nuevo coronavirus, llamado SARS cov-2, aparecido en China en diciembre del 2019, Se estima que el 85% de los casos de infección por este virus presentarán síntomas leves, un 15% síntomas moderados y un 5% síntomas severos que pueden llevar a la muerte.
                                </p>
                                <p class="text-justify">
                                    Desde la identificación del virus causante de la pandemia se ha ido desarrollando diversas vacunas contra la COVID-19 y algunas ya se encuentran disponibles para su uso en el contexto de la emergencia sanitaria.
                                </p>
                                <p class="text-justify">
                                    La vacunación es la principal herramienta para la prevención de la COVID-19 y se espera que cuando la mayoría de la población se encuentre vacunada (entre el 70-85%), la transmisión del virus en la comunidad sea mínima.
                                </p>
                                <p class="text-justify">
                                    Las vacunas contra la COVID-19 reduce significativamente la posibilidad de presentar síntomas o complicaciones a causa de la infección por el SARS-Cov-2.
                                </p>
                                <p class="text-justify">
                                    Se está ofreciendo a usted una vacuna, aprobada por el Ministerio de Salud, contra la COVID-19. Las características de la vacuna, el procedimiento para la vacunación, así como los beneficios a los riesgos de esta, serán informados y explicados por el personal de salud a cargo. Luego de ello, usted decidirá voluntariamente continuar con el proceso de vacunación.
                                </p>
                                <p class="text-justify">
                                    De manera general, la mayoría de los eventos adversos presentados por los vacunados por los vacunados se localizan en el lugar de la inyección: dolor, ligera hinchazón, enrojecimiento, se ha reportado algunas reacciones sistémicas como dolor de cabeza, malestar general, dolores musculares o cansancio. Estas reacciones se resuelven entre 48 a 72 horas después de la vacunación.
                                </p>
                                <p class="text-justify">
                                    Posterior a recibir la vacuna, usted se quedará 30 minutos en observación, para posteriormente retirarse.
                                </p>
                                <p class="text-justify">
                                    Se le hará entrega de una cartilla, donde se registra la vacunación y que deberá conservar para dosis posteriores de la vacuna.
                                </p>
                                <p class="text-justify">
                                    En caso presenta alguna molestia, debe acercarse inmediatamente al establecimiento de salud posteriores de la vacuna.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <div class="m-auto inline-block" style="width: auto; text-align:center">
                                    @if($firmartraije=='consentimiento')
                                        <img src="{{asset('firmas/'.$firmaConsentimiento1)}}" style="max-height:85px;" alt="">
                                    @elseif($firmartraije=='desistimiento')
                                        <img src="{{asset('firmas/'.$firmaDesistimiento)}}" style="max-height:85px;" alt=""> 
                                    @else
                                    <div class="linea_bottom" style="width: 220px; text-align: center;">
                                        &nbsp;
                                    </div>
                                    @endif
                                
                                </div>
                                <p class="sub m-auto text-center-important">Firma o huella digital del paciente</p>
                                <p class="mt-3">DNI N° <span class="understroke">{!!$campo_documento!!}</span></p>
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
            
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button type="button" wire:click.pevent="$toggle('mostrarconsentimiento1ra2da18mas')" wire:loading.attr="disabled">
                CANCELAR
            </x-secondary-button>
            <x-button type="button" id="signature1ra2da18mas">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white loading-docs hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>  PROCESAR DOCUMENTOS
            </x-button>
        </x-slot>
    </x-form-modal>
    