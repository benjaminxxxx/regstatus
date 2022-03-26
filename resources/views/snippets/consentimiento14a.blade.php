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
.sub.withline:before{
    content: "";
    top: 3px;
    width: 100%;
    height: 3px;
    position: absolute;
    border-top: 2px solid;
    border-style: dotted;
    
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
</style>
    
<x-form-modal submit="generardocumento" wire:model="mostrarconsentimiento14a" maxWidth="max-tablet">
    <x-slot name="title">
        &nbsp;
    </x-slot>

    
    
    <x-slot name="content">
        <div class="px-2 md:px-5 lg:px-5">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <p class="title">ANEXO N° 14-A</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="content">EXPRESIÓN DE CONSENTIMIENTO INFORMADO</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-small">
                                <tr>
                                    <td width="50%">
                                        <p class="header2">Apellidos y Nombre de la persona que va ser vacunada:</p>
                                    </td>
                                    <td width="50%">
                                        <p>{{mb_strtoupper($nombres)}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        <p class="header2">DNI de la persona que va ser vacunada:</p>
                                    </td>
                                    <td>
                                        <p>{{mb_strtoupper($documento)}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="header2">Teléfono de contacto:</p>
                                    </td>
                                    <td>
                                        <p>{{mb_strtoupper($telefono)}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="header2">Apellidos y Nombre del acompañante:</p>
                                    </td>
                                    <td>
                                        <p>{{mb_strtoupper($companion_nombres)}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="header2">DNI del acompañante:</p>
                                    </td>
                                    <td>
                                        <p>{{mb_strtoupper($companion_documento)}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="header2">Teléfono del acompañante:</p>
                                    </td>
                                    <td>
                                        <p>{{mb_strtoupper($companion_telefono)}}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="header">DATOS DE LA PERSONA QUE VA A SER VACUNADA:</p>
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
                                    <td>
                                        
                                        <p>Yo, <span class="understroke">{!!$nombre_completo!!}</span></p>
                                    </td>
                                    <td>
                                        <p class="text-right">con DNI <span class="understroke">{!!$campo_documento!!}</span></p>
                                    </td>
                                </tr>
                            </table>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="mt-3">declaro lo siguiente:</p>
                            <p class="text-justify">
                                SI (
                                    <span><input type="radio" required wire:model.defer="documento2_pre1" name="doc2pre1" value="SI"></span>
                                ) NO (
                                    <span><input type="radio" required wire:model.defer="documento2_pre1" name="doc2pre1" value="NO"></span>
                                ) tengo síntomas compatibles con COVID-19; o he dado positivo a una prueba COVID-19, en las últimas dos semanas; o estoy en seguimiento clínico por COVID-19.
                            </p>
                            <p class="text-justify">
                                SI (
                                    <span><input type="radio" required wire:model.defer="documento2_pre2" name="doc2pre2" value="SI"></span>
                                ) NO (
                                    <span><input type="radio" required wire:model.defer="documento2_pre2" name="doc2pre2" value="NO"></span>
                                ) he tenido contacto con alguien que dio positivo a la COVID-19, en las últimas dos semanas; o estoy en cuarentena.
                            </p>
                            <p class="text-justify">
                                En ese sentido, he sido informado (a) de los beneficios y los potenciales efectos adversos de la Vacuna contra el COVID-19 y, resueltas todas las preguntas y dudas al respecto, consciente de mis derechos y de forma voluntaria, eh cumplimiento de la normativa vigente; 
                            </p><p>    SI (<span><input type="radio" required wire:model.defer="documento2_pre3" name="doc2pre3" value="SI"></span>) 
                                NO (<span><input type="radio" required wire:model.defer="documento2_pre3" name="doc2pre3" value="NO"></span>) doy mi consentimiento para que el personal de salud me aplique la vacuna contra el COVID-19
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
                                                <div id="signaturesign1" style="max-width:298px;background: #efefef;"></div>
                                            </div>
                                            <div id="tools"></div>
                                        </div>
                                        <p class="sub">Firma o huella digital del paciente o representante legal</p>
                                        <p class="mt-3">DNI N° <span class="understroke"><span class="firmap firmap1">{!!$campo_documento!!}</span></span></p>
                                    </td>
                                    <td width="45%">
                                        <div class="firma relative" style="min-height: 5rem">
                                            @if ($firmartraije=='consentimiento')
                                                <img src="{{asset('firmas/'.Auth::user()->firma)}}" class="h-20 m-auto" alt="">
                                            @endif
                                            <input type="radio" wire:model="firmartraije" wire:change="getdoc1firma('1')" name="firmartraije" class="absolute right-0 top-10" value="consentimiento">
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
                                                <div id="signaturesign2" style="max-width:298px;background: #efefef;"></div>
                                            </div>
                                            <div id="tools"></div>
                                        </div>
                                        <p class="sub">Firma o huella digital del paciente o representante legal</p>
                                        <p class="mt-3">DNI N° <span class="understroke"><span class="firmap firmap2">{!!$campo_documento!!}</span></span></p>
                                    </td>
                                    <td width="45%">
                                        <div class="firma relative" style="min-height: 5rem">
                                            @if ($firmartraije=='desistimiento')
                                                <img src="{{asset('firmas/'.Auth::user()->firma)}}" class="h-20 m-auto" alt="">
                                            @endif
                                            <input type="radio" wire:model="firmartraije" wire:change="getdoc1firma('2')" name="firmartraije" class="absolute right-0 top-10" value="desistimiento">
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
        <x-secondary-button type="button" wire:click.pevent="mostrarElConsentimiento" wire:loading.attr="disabled">
            ATRÁS
        </x-secondary-button>
        <x-button type="button" id="signature1">
            SIGUIENTE
        </x-button>
    </x-slot>
</x-form-modal>
    