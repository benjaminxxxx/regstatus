<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,400&display=swap" rel="stylesheet">
<style>
    .bg-purple{
        background: url('{{public_path('images/test.svg')}}');
        
    }
    @page { margin: 10px 100px 10px 100px !important; padding: 0px 0px 0px 0px !important; }
    html *{ font-family: 'Roboto', sans-serif; font-size: 13px; }
    .relative{
        position: relative;
    }
    .absolute{
        position: absolute;
        
    }
    .linea_bottom{
        display: inline-block;
        padding: 1px;
        border-bottom:1px solid #000;
    }
    .no_line_botton{
        display: inline-block;
        padding: 1px;
        border-bottom:1px solid #fff;
    }
    div.content{ max-width: 600px; margin:0 auto; }
    .max-500{ max-width: 560px; margin:0 auto; }
    .w-full{width: 100%}
    .title,.title-spacer{ font-weight: bold; font-size: 13px; text-align: center; width: 100%; max-width: 669px; margin: 0 auto; }
    p{ padding: 0; margin: 0; }
    .table{ width: 100%; margin-top:10px; table-layout: fixed }
    .table th,.table td{ padding: 2px 5px; border:1px solid rgb(39, 39, 39) !important; }
    table{border-collapse: collapse;}
    th,.header{ font-weight: bold; text-transform: uppercase; font-size: 14px; text-align: center; }
    .table-layout{ table-layout: fixed }
    .mt-2,.mt-3{margin-top:10px;}
    .tobottom{ position: absolute; bottom: 0; text-align: left }
    .text-justify{ text-align: justify; font-size:13px; margin-bottom: 6px; font-weight: 400; }
    .sub{ position: relative; max-width: 296px; text-align: left; font-weight: normal; }
    .header2{ font-size: 14px; text-align: left; font-weight: bold }
    .py-2{ padding: 7px 0 }
    .linea_dni{ position: absolute; left:40px; }
    .relative_linea{ position: relative; display: inline-block; margin-top:7px; }
    .firma{margin-top:4px;}
    .center{
        text-align: center;
        vertical-align: middle !important;
    }
    .max-telf{
        word-break: break-word;
    }
    .max-telf p{
        max-width: 99px;
        display: block;
        margin: 0 auto;
    }
    .text-center{
        text-align: center
    }
    .m-auto{
        margin:0 auto;
    }
</style>
</head>
<body class="bg-purple">
    <div class="content">
   
        <table class="w-full" >
            <tr>
                <td align="left">
                    <img src="{{public_path('images/logo-essalud.png')}}" style="max-width: 100px" alt="">
                </td>
                <td align="right">
                    <img src="{{public_path('images/logo-bicentenario-foo.png')}}" style="max-width: 100px" alt="">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p style="font-size:11px;text-align:center;margin-bottom:28px">MANUAL DE VACUNACIÓN SEGURA CONTRA LA COVID-19 EN EL SEGURO SOCIAL DE SALUD – ESSALUD V.5</p>
                </td>
            </tr>
        </table>
        <table>
            <tbody>
                
                <tr>
                    <td class="title">
                        ANEXO N° 13
                    </td>
                    
                </tr>
                <tr>
                    <td class="content">
                        CRITERIOS DE ELIGIBILIDAD PARA EL PERSONAL DE SALUD PARA APLICACIÓN DE LA VACUNA CONTRA LA COVID-19
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="table">
                            <tr>
                                <td width="40%">
                                    <p class="header">RED / GERENCIA</p>
                                </td>
                                <td colspan="3"  width="60%">
                                    <p class="header">ESTABLECIMIENTO DE SALUD</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="center">{{mb_strtoupper($documento1_redgerencia)}}</p>
                                </td>
                                <td colspan="3">
                                    <p class="center">{{mb_strtoupper($documento1_establecimiento)}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p class="header">NOMBRES Y APELLIDOS</p>
                                </td>
                                <td width="70px">
                                    <p class="header">EDAD</p>
                                </td>
                                <td width="140px">
                                    <p class="header">DNI</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p class="center">{{mb_strtoupper($nombres)}}</p>
                                </td>
                                <td>
                                    <p class="center">{{mb_strtoupper($edad)}}</p>
                                </td>
                                <td>
                                    <p class="center">{{mb_strtoupper($documento)}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p class="header">DOMICILIO</p>
                                </td>
                                <td class="max-telf">
                                    <p class="header">TELF. DE CONTACTO</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p class="center">{{mb_strtoupper($domicilio)}}</p>
                                </td>
                                <td>
                                    <p class="center">{{mb_strtoupper($telefono)}}</p> 
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="w-full">
                            <table class="table">
                              
                                <tbody>
                                    <tr>
                                        <td width="76%" class="header">Preguntas de detección de COVID-19</td>
                                        <td width="40px" class="header">SI</td>
                                        <td width="40px" class="header">NO</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1. En las últimas dos semanas, ¿ha dado positivo en COVID-19 o actualmente está siendo monitoreado por COVID-19?
                                        </td>
                                        <td class="center" valign="middle" width="40px" style="text-align: center">
                                            @if($documento1_pre1=='SI')
                                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                            @endif
                                        </td>
                                        <td class="center" valign="center" width="40px" style="text-align: center">
                                            @if($documento1_pre1=='NO')
                                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            2. En las últimas semanas, ¿ha tenido contacto con alguien que dio positivo en COVID-19? ¿Está en cuarentena?
                                        </td>
                                        <td class="center" valign="middle" style="text-align: center">
                                            @if($documento1_pre2=='SI')
                                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                            @endif
                                        </td>
                                        <td class="center" valign="center" style="text-align: center">
                                            @if($documento1_pre2=='NO')
                                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3. ¿ Tiene actualmente o ha tenido en los últimos 14 días fiebre, escalofríos, tos, dificultad para respirar, falta de aire, fatiga, dolores musculares o corporales, dolor de cabeza, pérdida del gusto y del olfato, dolor de garganta , náuseas, vómitos o diarrea?
                                        </td>
                                        <td class="center" valign="middle" style="text-align: center">
                                            @if($documento1_pre3=='SI')
                                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                            @endif
                                        </td>
                                        <td class="center" valign="center" style="text-align: center">
                                            @if($documento1_pre3=='NO')
                                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="mt-2"> 
                            <b>SI LA RESPUESTA A ALGUNA DE LAS PREGUNTAS ES SÍ, SE POSTERGA LA VACUNACIÓN. </b>
                        </p> 
                        <p class="mt-2">
                            <b>    90 DÍAS DESPUÉS DEL ALTA EN LOS CASOS DE LA PREGUNTA 1 Y 3. 14 DÍAS DESPUES DE CULMINADA SU CUARENTENA EN EL CASO DE LA PREGUNTA 2.</b>
                        </p>
                        
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="tobottom">
            <hr>
            <p style="font-size: 10px"><sup style="font-size: 8px">15</sup> Directiva Sanitaria No133-MINSA/2021/DGIESP</p>
        </div>
    </div>
    <div style="page-break-before: always;"></div>
    @php
        $nombre_sp = mb_strtoupper($nombres);
        /*$spaces = 20 - strlen($nombre_sp);
        $nombre_puntos = str_repeat('<span class="sp">&nbsp;</span>',$spaces);
        $nombre_completo = $nombre_sp . $nombre_puntos;
    */
        /*DIA*/
        $campo_dia = str_pad(date('d',strtotime($fecha)),2,'0',STR_PAD_RIGHT);
    

        $meses = [
            '01'=>'enero','02'=>'febrero','03'=>'marzo','04'=>'abril',
            '05'=>'mayo','06'=>'junio','07'=>'julio','08'=>'agosto',
            '09'=>'septiembre','10'=>'octubre','11'=>'noviembre','12'=>'diciembre'
        ];
        
        $campo_meses = $meses[date('m',strtotime($fecha))];
      

        /*DOCUMENTO*/
        $campo_documento = mb_strtoupper($documento);
        /*$espacio_documento = 12 - strlen($campo_documento);
        
        if($espacio_documento%2!=0){
            $espacio_documento++;
        }
        $totalporlado_documento = $espacio_documento / 2;

        $cantidad_adicional_documento = str_repeat('<span class="sp">&nbsp;</span>',$totalporlado_documento);

        $campo_documento=$cantidad_adicional_documento . $campo_documento . $cantidad_adicional_documento;
*/
        /*HORA*/
        $nhora = $hora;
        if(!$nhora || $nhora==null){
            $nhora = date('h:i A');
        }
        $campo_hora = $nhora;

        /*$espacio_hora = 12 - strlen($campo_hora);
        
        if($espacio_hora%2!=0){
            $espacio_hora++;
        }
        $totalporlado_hora=$espacio_hora/2;

        $cantidad_adicional_hora = str_repeat('<span class="sp">&nbsp;</span>',$totalporlado_hora);

        $campo_hora=$cantidad_adicional_hora . $campo_hora . $cantidad_adicional_hora;*/
    @endphp
    <div class="content">
        <table class="w-full">
            <tr>
                <td style="text-align: left">
                    <img src="{{public_path('images/logo-essalud.png')}}" style="max-width: 100px" alt="">
                </td>
                <td style="text-align: right">
                    <img src="{{public_path('images/logo-bicentenario-foo.png')}}" style="max-width: 100px; object-fit:cover" alt="">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p style="font-size:11px;text-align:center;margin-bottom:2px">MANUAL DE VACUNACIÓN SEGURA CONTRA LA COVID-19 EN EL SEGURO SOCIAL DE SALUD – ESSALUD V.5</p>
                </td>
            </tr>
            <tr>
                <td  colspan="2" class="title">
                ANEXO N° 14-A
                </td>
            </tr>
            <tr>
                <td  colspan="2" class="content">
                    EXPRESIÓN DE CONSENTIMIENTO INFORMADO
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="max-500">
                        <table class="table table-layout">
                            <tr>
                                <td width="50%">
                                    <p class="header2">Apellidos y Nombre de la persona que va ser vacunada:</p>
                                </td>
                                <td width="50%">
                                    <p>{{mb_strtoupper($nombres)}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td  class="header2" >
                                    DNI de la persona que va ser vacunada:
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
                    </div>
                    
                </td>
            </tr>
            <tr>
                <td  colspan="2">
                    <p class="header py-2">DATOS DE LA PERSONA QUE VA A SER VACUNADA:</p>
                    <br/>
                    <br/>
                </td>
            </tr>
            <tr>
                <td  colspan="2">
                    <table width="600px">
                        <tr>
                            <td width="70%">
                                <div class="no_line_botton">Fecha:</div> 
                                <div class="linea_bottom" style="width:31px;text-align:center">{{$campo_dia}}</div>
                                <div class="no_line_botton">de</div> 
                                <div class="linea_bottom" style="width: 105px;text-align:center">{{$campo_meses}}</div>
                                <div class="no_line_botton">de {{date('Y',strtotime($fecha))}}</div> 
                            </td>
                            <td>
                                <div class="no_line_botton">Hora:</div>
                                <div class="linea_bottom" style="width: 68px;;text-align:center">{{$campo_hora}}</div>
                            </td>
                            
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="no_line_botton">Yo,</div> 
                                <div class="linea_bottom" style="width:390px">{{$nombre_sp}}</div>
                                <div class="no_line_botton">con DNI </div>
                                <div class="linea_bottom" style="width: 112px; text-align: center;">{{$campo_documento}}</div>
                            </td>
                        </tr>
                    </table>
                  
                    
                </td>
            </tr>
            <tr>
                <td  colspan="2">
                    <p class="mt-3">Declaro lo siguiente:</p>
                    <p class="text-justify">
                        SI (
                            @if($documento2_pre1=='SI')
                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                            @endif
                        ) NO (
                            @if($documento2_pre1=='NO')
                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                            @endif
                        ) tengo síntomas compatibles con COVID-19; o he dado positivo a una prueba COVID-19, en las últimas dos semanas; o estoy en seguimiento clínico por COVID-19.
                    </p>
                    <p class="text-justify">
                        SI (
                            @if($documento2_pre2=='SI')
                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                            @endif
                        ) NO (
                            @if($documento2_pre2=='NO')
                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                            @endif
                        ) he tenido contacto con alguien que dio positivo a la COVID-19, en las últimas dos semanas; o estoy en cuarentena.
                    </p>
                    <p class="text-justify">
                        @php
                            $sp_doc2_pre3 = '&nbsp;&nbsp;&nbsp;';
                            if($documento2_pre3=='NO'){
                                $sp_doc2_pre3 = '<img src="'.public_path('images/check.png').'" style="max-width:15px" alt="">';
                            }
                        @endphp
                        En ese sentido, he sido informado (a) de los beneficios y los potenciales efectos adversos de la Vacuna contra el COVID-19 y, resueltas todas las preguntas y dudas al respecto, consciente de mis derechos y de forma voluntaria, eh cumplimiento de la normativa vigente; 
                    </p><p class="text-justify"> SI (
                            @if($documento2_pre3=='SI')
                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                            @endif
                            ) 
                        NO ({!!$sp_doc2_pre3!!}) doy mi consentimiento para que el personal de salud me aplique la vacuna contra el COVID-19
                    </p>
                </td>
            </tr>

        
            <tr>
                <td colspan="2">
                    <table class="w-full layout-fixed" style="table-layout: fixed">
                        <tr>
                            <td width="50%" style="padding-right: 20px;">
                                <div class="firma" style="min-height: 125px;">
                                    @if($firmartraije=='consentimiento')
                                    <img src="{{public_path('firmas/'.$firmaConsentimiento1)}}" style="max-height:85px;" alt="">
                                    @else
                                    <div class="linea_bottom" style="width: 220px; text-align: center;">
                                        &nbsp;
                                    </div>
                                    @endif
                                </div>
                            </td>
                            @if(!isset($triador_nombre))
                            <td width="50%" style="padding-left: 20px">
                                <div class="firma" style="min-height: 125px; text-align:center">
                                    @if($firmartraije=='consentimiento')
                                    @if(Auth::user()->firma!=null)
                                    <img src="{{public_path('firmas/' . Auth::user()->firma)}}" style="margin-bottom:-20px;max-height:85px" alt="">
                                    @endif
                                    @else
                                    <div class="linea_bottom" style="width: 220px; text-align: center;">
                                        &nbsp;
                                    </div>
                                    @endif
                                </div>
                            </td>
                            @else
                            <td width="50%" style="padding-left: 20px">
                                <div class="firma" style="min-height: 125px; text-align:center">
                                    @if($firmartraije=='consentimiento')
                                    @if($triador_firma!=null)
                                    <img src="{{public_path('firmas/' . $triador_firma)}}" style="margin-bottom:-20px;max-height:85px" alt="">
                                    @endif
                                    @else
                                    <div class="linea_bottom" style="width: 220px; text-align: center;">
                                        &nbsp;
                                    </div>
                                    @endif
                                </div>
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td width="50%" style="padding-right: 20px">
                            
                                <p class="sub">Firma o huella digital del paciente o representante legal 2</p>
                                <p class="mt-3">
                                    <div class="no_line_botton">DNI N° </div> 
                                    <div class="linea_bottom" style="width: 112px; text-align: center;">
                                        @if($firmartraije=='consentimiento')
                                            {{$campo_documento}}
                                        @endif
                                    </div>
                                </p>
                            </td>
                            <td width="50%" style="padding-left: 20px">
                            
                                <p class="sub">Firma y sello del personal de salud que informa y toma el consentimiento</p>
                                <p class="mt-3">
                                    <div class="no_line_botton">DNI N° </div> 
                                    <div class="linea_bottom" style="width: 112px; text-align: center;">
                                        @if($firmartraije=='consentimiento')
                                            @if (isset($triador_dni))
                                            {{$triador_dni}}
                                                @else
                                                {{Auth::user()->dni}}
                                            @endif
                                            
                                        @endif
                                    </div>
                                </p>
                            </td>
                        </tr>
                    </table>
                    
                </td>
            </tr>
            @php
            $campo_documento2 = $campo_documento;
            if($firmartraije!='desistimiento'){
                $campo_dia = '';
                $campo_meses = '';
                $campo_hora = '';
                $campo_documento = '';
            }
            
            @endphp
            <tr>
                <td colspan="2" style="padding:20px;"><p style="text-align:center">REVOCATORIA / DESISTIMIENTO DEL CONSENTIMIENTO:</p></td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="600px">
                        <tr>
                            <td width="70%">
                                <div class="no_line_botton">Fecha:</div> 
                                <div class="linea_bottom" style="width:31px;text-align:center">{{$campo_dia}}</div>
                                <div class="no_line_botton">de</div> 
                                <div class="linea_bottom" style="width: 105px;text-align:center">{{$campo_meses}}</div>
                                <div class="no_line_botton">de {{date('Y',strtotime($fecha))}}</div> 
                            </td>
                            <td>
                                <div class="no_line_botton">Hora:</div>
                                <div class="linea_bottom" style="width: 68px;;text-align:center">{{$campo_hora}}</div>
                            </td>
                            
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <table class="w-full">
                        <tr>
                            <td width="50%" style="padding-right: 20px">
                                <div class="firma" style="min-height: 125px;">
                                    @if($firmartraije=='desistimiento')
                                    <img src="{{public_path('firmas/'.$firmaDesistimiento)}}" style="max-height:85px;" alt=""> 
                                    @else
                                    <div class="linea_bottom" style="width: 220px; text-align: center;">
                                        &nbsp;
                                    </div>
                                    @endif
                                    
                                </div>
                            </td>
                            <td width="50%" style="padding-left: 20px">
                                <div class="firma" style="min-height: 125px; text-align:center">
                                    @if($firmartraije=='desistimiento')
                                    @if(Auth::user()->firma!=null)
                                    <img src="{{public_path('firmas/' . Auth::user()->firma)}}" style="margin-bottom:-20px;max-height:85px" alt="">
                                    @endif
                                    @else
                                    <div class="linea_bottom" style="width: 220px; text-align: center;">
                                        &nbsp;
                                    </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" style="padding-right: 20px">
                            
                                <p class="sub">Firma o huella digital del paciente o representante legal</p>
                                <p class="mt-3">
                                  
                                    <div class="no_line_botton">DNI N° </div> 
                                    <div class="linea_bottom" style="width: 112px; text-align: center;">
                                        @if($firmartraije=='desistimiento')
                                            {{$campo_documento}}
                                        @endif
                                    </div>
                                </p>
                            </td>
                            <td width="50%" style="padding-left: 20px">
                            
                                <p class="sub">Firma y sello del personal de salud que informa y toma la revocatoria</p>
                                <p class="mt-3">
                                    <div class="no_line_botton">DNI N° </div> 
                                    <div class="linea_bottom" style="width: 112px; text-align: center;">
                                        @if($firmartraije=='desistimiento')
                                            {{Auth::user()->dni}}
                                        @endif
                                    </div>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="tobottom">
            <hr>
            <p style="font-size: 10px"><sup style="font-size: 8px">15</sup> Directiva Sanitaria No133-MINSA/2021/DGIESP</p>
        </div>
    </div>
    <div style="page-break-before: always;"></div>
<div class="content">
    <table class="w-full">
        <tr>
            <td style="text-align: left">
                <img src="{{public_path('images/logo-essalud.png')}}" style="max-width: 100px" alt="">
            </td>
            <td style="text-align: right">
                <img src="{{public_path('images/logo-bicentenario-foo.png')}}" style="max-width: 100px; object-fit:cover" alt="">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p style="font-size:11px;text-align:center;margin-bottom:2px">MANUAL DE VACUNACIÓN SEGURA CONTRA LA COVID-19 EN EL SEGURO SOCIAL DE SALUD – ESSALUD V.5</p>
            </td>
        </tr>
        <tr>
            <td  colspan="2" class="title">
               ANEXO N° 14-B
            </td>
        </tr>
        <tr>
            <td  colspan="2" class="content">
                HOJA INFORMATIVA SOBRE LA VACUNA CONTRA LA COVID-19
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
                    La vacunación es la w-full herramienta para la prevención de la COVID-19 y se espera que cuando la mayoría de la población se encuentre vacunada (entre el 70-85%), la transmisión del virus en la comunidad sea mínima.
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
            <td colspan="2" class="text-center">
                <div class="m-auto" style="width: auto; text-align:center">
                    <div class="firma">
                        @if($firmartraije=='consentimiento')
                            <img src="{{public_path('firmas/'.$firmaConsentimiento1)}}" style="max-height:85px;" alt="">
                        @elseif($firmartraije=='desistimiento')
                            <img src="{{public_path('firmas/'.$firmaDesistimiento)}}" style="max-height:85px;" alt=""> 
                        @else
                        <div class="linea_bottom" style="width: 220px; text-align: center;">
                            &nbsp;
                        </div>
                        @endif
                        
                    </div>
                    <p class="sub m-auto text-center-important">Firma o huella digital del paciente o apoderado</p>
                    
                    <div class="mt-3" style=" margin: 0 auto; max-width:200px">
                        
                        <div class="no_line_botton">DNI N° </div> 
                        <div class="linea_bottom" style="width: 112px; text-align: center;">
                            {{$campo_documento2}}
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <div class="tobottom">
        <hr>
        <p style="font-size: 10px"><sup style="font-size: 8px">15</sup> Directiva Sanitaria No133-MINSA/2021/DGIESP</p>
    </div>
</div>
@if($archivosAdjuntos!=null) 
    
    @foreach ( $archivosAdjuntos as $adjunto)
    <div style="page-break-before: always;"></div>
    <div class="content">
        <img src="{{public_path('firmas/' . $adjunto->nombrearchivo)}}" style="max-width: 100%; max-height:100%" alt="">
    </div>     
    @endforeach
@endif
</body>
</html>