@php
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

    /*DOCUMENTO*/
    $campo_documento = mb_strtoupper($documento);
    $espacio_documento = 12 - strlen($campo_documento);
    
    if($espacio_documento%2!=0){
        $espacio_documento++;
    }
    $totalporlado_documento = $espacio_documento / 2;

    $cantidad_adicional_documento = str_repeat('<span class="sp">&nbsp;</span>',$totalporlado_documento);

    $campo_documento=$cantidad_adicional_documento . $campo_documento . $cantidad_adicional_documento;

    /*HORA*/
    $campo_hora = date('h:i A');
    $espacio_hora = 12 - strlen($campo_hora);
    
    if($espacio_hora%2!=0){
        $espacio_hora++;
    }
    $totalporlado_hora=$espacio_hora/2;

    $cantidad_adicional_hora = str_repeat('<span class="sp">&nbsp;</span>',$totalporlado_hora);

    $campo_hora=$cantidad_adicional_hora . $campo_hora . $cantidad_adicional_hora;
@endphp
<style>
.title,.content,.title-spacer{
    font-weight: bold;
    font-size: 16px;
    text-align: center;
    width: 100%;
    font-family: Arial;
    max-width: 669px;
    margin: 0 auto;
}
.title-spacer{
    margin-top: 26px !important;
    margin-bottom: 18px !important;
}
.table{
    width: 100%;
    font-family: Arial;
    margin-top:20px;
}
.table th,.table td{
    border:1px solid rgb(39, 39, 39) !important;
}
th,.header{
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    text-align: center;
}
.header2{
    font-size: 14px;
    text-align: left;
    font-style: italic;
    font-weight: 600
}
.center{
    text-align: center
}
.max-telf{
    word-break: break-word;
}
.max-telf p{
    max-width: 99px;
    display: block;
    margin: 0 auto;
}
.table td:nth-child(4) {
    width: 99px;
}
.table-small{
    max-width: 548px;
    margin: 19px auto;
}
.understroke{
    position: relative
    /*border-bottom: 2px dotted;*/
}
.understroke:before{
    content: "";
    bottom: 2px;
    width: 100%;
    height: 3px;
    position: absolute;
    border-bottom: 2px solid;
    border-style: dotted;
}
.sp{
    display: inline-block;
    width: 10px;
}
.max-tablet{
    max-width: 765px;

}
.text-justify{
    text-align: justify
}
.sub{
    position: relative;
    max-width: 296px;
    font-weight: bold;
    text-align: left;
}

.right-to-left{
    float: right;
    text-align: left;
}
.left-to-center{
    float: left;
    width: 100%;
    text-align: center;
}
.text-center-important{
    text-align: center !important
}
.text-center{
    text-align: center
}
</style>
    
<x-form-modal submit="procesardocumentos" wire:model="mostrarconsentimiento14b" maxWidth="max-tablet">
    <x-slot name="title">
        &nbsp;
    </x-slot>

    
    
    <x-slot name="content">
        <div class="px-2 md:px-5 lg:px-5">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <p class="title">ANEXO N° 14-B</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="content">HOJA INFORMATIVA SOBRE LA VACUNA CONTRA LA COVID-19</p>
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
                                <!--
                                <div id="signatureparent">
                                    <div id="signaturesign3" style="max-width:298px;background: #efefef;margin: 0 auto;"></div>
                                </div>
                                <div id="tools"></div>-->
                            </div>
                            <p class="sub m-auto text-center-important">Firma o huella digital del paciente o apoderado</p>
                            <p class="mt-3">DNI N° <span class="understroke">{!!$campo_documento!!}</span></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button type="button" wire:click.pevent="mostrarElConsentimiento14a" wire:loading.attr="disabled">
            ATRÁS
        </x-secondary-button>
        <x-button type="button" id="signature3">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white loading-docs hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg> PROCESAR DOCUMENTOS
            
        </x-button>
    </x-slot>
</x-form-modal>
    