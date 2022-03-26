@php

$nombre_sp = mb_strtoupper($nombres);
    /*DIA*/
    $campo_dia = str_pad(date('d'),2,'0',STR_PAD_RIGHT);

    /*MES*/
    $meses = [
        '01'=>'enero','02'=>'febrero','03'=>'marzo','04'=>'abril',
        '05'=>'mayo','06'=>'junio','07'=>'julio','08'=>'agosto',
        '09'=>'septiembre','10'=>'octubre','11'=>'noviembre','12'=>'diciembre'
    ];
    
    $campo_meses = $meses[date('m')];
    
    /*DOCUMENTO*/
    $campo_documento = mb_strtoupper($documento);
    
    /*HORA*/
    $campo_hora = date('h:i A');

    $mamacondni = $companion_nombres . ' con DNI: ' . $companion_documento;
    $parientede = $companion_tipo . ' DEL MENOR ' . mb_strtoupper($nombres);

    $ac = '22px'; //ancho del check

    $para = 'PERSONAL DE LA SALUD, PERSONAL ADMINISTRATIVO Y PERSONAL QUE BRINDA SERVICIOS GENERALES DE LAS INSTITUCIONES PRESTADORAS DE SERVICIO DE SALUD.';
    $personal_de_salud = [
        'PERSONAL DE ESSALUD'
    ];
    $mayor_de_edad = [
        '50-59 AÑOS','MENORES DE 50','30-39 AÑOS','20-29 AÑOS','40-49 AÑOS','18-20 AÑOS','18 y 19 AÑOS'
    ];
    $arr_mayor_a_60 = [
        '60-69 AÑOS','70-79 AÑOS','80 A MAS'
    ];
    if(in_array($grupoderiesgo,$personal_de_salud)){
        $para = 'PERSONAL DE LA SALUD, PERSONAL ADMINISTRATIVO Y PERSONAL QUE BRINDA SERVICIOS GENERALES DE LAS INSTITUCIONES PRESTADORAS DE SERVICIO DE SALUD.';
    }
    if(in_array($grupoderiesgo,$mayor_de_edad)){
        $para = 'EL MAYOR DE EDAD';
    }
    if(in_array($grupoderiesgo,$arr_mayor_a_60)){
        $para = 'PERSONAS MAYORES DE 60 AÑOS';
    }
@endphp
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
    .title,.title-spacer{ font-weight: bold; font-size: 13px; text-align: center; width: 100%; max-width: 569px; margin: 0 auto; }
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
    .text-sm{
        font-size: 11px;
    }
</style>
</head>
<body class="bg-purple">
    <div class="sellos" style="position:absolute; left:-70px;bottom:160px;">
        <img src="{{public_path('images/sellos.jpg')}}" width="60px" alt="">
    </div>
    <div class="content">
        <table class="w-full">
            <tr>
                <td class="text-center" colspan="2">
                    <br>
                    <br>
                    <p class="title">

                        <span style="font-size: 11px">“Manual de Vacunación Segura contra la COVID-19 en el Seguro Social de Salud- EsSaLUD-V.T”</span>
                        
                        <br>

                        ANEXO N° 5-C
                        <br>
                        DOSIS DE REFUERZO DE LA VACUNA CONTRA LA COVID-19

                        <br>
                    
                        EXPRESIÓN DE CONSENTIMIENTO INFORMADO</p>
                </td>
            </tr>
           
            <tr>
                <td  colspan="2">
                    <table width="600px" style="margin-top:120px">
                        <tr>
                            <td width="70%">
                                <div class="no_line_botton">Fecha:</div> 
                                <div class="linea_bottom" style="width:31px;text-align:center">{{$campo_dia}}</div>
                                <div class="no_line_botton">de</div> 
                                <div class="linea_bottom" style="width: 105px;text-align:center">{{$campo_meses}}</div>
                                <div class="no_line_botton">de {{date('Y')}}</div> 
                            </td>
                            <td>
                                <div class="no_line_botton">Hora:</div>
                                <div class="linea_bottom" style="width: 68px;;text-align:center">{{$campo_hora}}</div>
                            </td>
                            
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="no_line_botton">Yo,</div> 
                                <div class="linea_bottom" style="width:290px">{{$nombre_sp}} </div>
                                <div class="no_line_botton"> con DNI: </div>
                                <div class="linea_bottom" style="width: 112px; text-align: center;">{{$campo_documento}}</div>
                                <div class="no_line_botton">declaro lo siguiente:</div>  
                            </td>
                        </tr>
                    </table>
                  
                    
                </td>
            </tr>
            <tr>
                <td colspan="2">
                   
                    <p>SI 
                            @if($child_documento2_pre1=='SI')7
                            <img src="{{public_path('images/checkyes.png')}}" style="max-width:{{$ac}}" alt="">
                            @else
                            <img src="{{public_path('images/checkno.png')}}" style="max-width:{{$ac}}" alt="">
                            @endif
                        
                        NO 
                            @if($child_documento2_pre1=='NO')
                            <img src="{{public_path('images/checkyes.png')}}" style="max-width:{{$ac}}" alt="">
                            @else
                            <img src="{{public_path('images/checkno.png')}}" style="max-width:{{$ac}}" alt="">
                            @endif
                            tiene síntomas compatibles con COVID-19; o ha dado positivo a una prueba    COVID-19, en las últimas dos semanas; o estoy en seguimiento clínico por COVID-19.
                    </p>
                    <p class="text-justify">
                        SI 
                            @if($child_documento2_pre2=='SI')
                            <img src="{{public_path('images/checkyes.png')}}" style="max-width:{{$ac}}" alt="">
                            @else
                            <img src="{{public_path('images/checkno.png')}}" style="max-width:{{$ac}}" alt="">
                            @endif 
                         NO 
                         @if($child_documento2_pre2=='NO')
                            <img src="{{public_path('images/checkyes.png')}}" style="max-width:{{$ac}}" alt="">
                            @else
                            <img src="{{public_path('images/checkno.png')}}" style="max-width:{{$ac}}" alt=""> 
                            @endif
                            tiene contacto con alguien que dio positivo  a  la COVID-19, en las últimas dos semanas ; o estuvo en cuarentena
                    </p>
                    <p class="text-justify">
                        En ese sentido, he sido informado (a) de los beneficios y los potenciales efectos adversos de la Vacuna contra la COVID-19 y, resueltas todas las preguntas y dudas al respecto, consciente de mis derechos y en forma voluntaria, en cumplimiento de la normativa vigente; 
                    </p>
                    <p>
                    SI 
                        @if($child_documento2_pre3=='SI')
                        <img src="{{public_path('images/checkyes.png')}}" style="max-width:{{$ac}}" alt="">
                        @else
                        <img src="{{public_path('images/checkno.png')}}" style="max-width:{{$ac}}" alt="">
                        @endif
                     NO 
                        @if($child_documento2_pre3=='NO')
                        <img src="{{public_path('images/checkyes.png')}}" style="max-width:{{$ac}}" alt="">
                            @else
                            <img src="{{public_path('images/checkno.png')}}" style="max-width:{{$ac}}" alt="">
                            @endif
                     doy mi consentimiento para que el personal de salud me aplique la vacuna contra el COVID-19.
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
                        </tr>
                        <tr>
                            <td width="50%" style="padding-right: 20px">
                            
                                <p class="sub">Firma o huella digital del paciente</p>
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
                                            {{Auth::user()->dni}}
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
                                <div class="no_line_botton">de {{date('Y')}}</div> 
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
                            
                                <p class="sub">Firma o huella digital del paciente</p>
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