@php

$nombre_sp = mb_strtoupper($nombres);
    /*DIA*/
    $campo_dia = str_pad(date('d',strtotime($fecha)),2,'0',STR_PAD_RIGHT);

    /*MES*/
    $meses = [
        '01'=>'enero','02'=>'febrero','03'=>'marzo','04'=>'abril',
        '05'=>'mayo','06'=>'junio','07'=>'julio','08'=>'agosto',
        '09'=>'septiembre','10'=>'octubre','11'=>'noviembre','12'=>'diciembre'
    ];
    
    $campo_meses = $meses[date('m',strtotime($fecha))];
    
    /*DOCUMENTO*/
    $campo_documento = mb_strtoupper($documento);
    
    /*HORA*/
    $nhora = $hora;
        if(!$nhora || $nhora==null){
            $nhora = date('h:i A');
        }
        $campo_hora = $nhora;
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
    .text-sm{
        font-size: 11px;
    }
</style>
</head>
<body class="bg-purple">
    <div class="content">
        <table class="w-full">
            <tr>
                <td style="text-align: left">
                    <img src="{{public_path('images/logo-essalud.png')}}" style="max-width: 100px" alt="">
                </td>
                <td style="text-align: right">
                    
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <p>???Decenio de la igualdad de oportunidades para mujeres y hombres???</p>
                    <p>???A??o de bicentenario del Per??: 200 a??os de independencia???</p>
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <p class="title">ANEXO N?? 2</p>
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <p class="content" style="font-size: 13px; margin-top:20px; margin-bottom:10px; font-weight:bold">Formato de Consentimiento informado para la Vacunaci??n contra la COVID-19</p>
                    <p class="content" style="font-size: 16px; margin-top:2px; margin-bottom:10px; font-weight:bold">HOJA INFORMATIVA SOBRE LA VACUNA CONTRA LA COVID-19 (LABORATORIO SINOPHARM)</p>
                </td>
            </tr>
            <tr>
                <td  colspan="2">
                    <p class="text-justify">
                        El Instituto de Productos Biol??gicos de Beijing crea una vacuna inactivada (virus muerto) contra el covid-19, los ensayos cl??nicos son desarrollados por la empresa estatal china Sinopharm. Con una eficacia del 79,34 %, es aprobada por el gobierno chino. Siendo una vacuna eficaz y segura para proteger a la poblaci??n est?? pendiente la publicaci??n de los resultados de fase 3. Los estudios de fase 1- 2 mostr?? que la vacuna no caus?? ning??n efecto secundario grave y permiti?? a las personas producir anticuerpos contra el coronavirus. En julio del 2020, comenz?? un ensayo de fase 3 en los Emiratos ??rabes Unidos, en Agosto del 2020 en Per?? y en Marruecos. En el pa??s los estudios han sido desarrollados por la Universidad Nacional Mayor de San Marcos y la Universidad Peruana Cayetano Heredia con 12,000 participantes. Es necesaria para lograr una adecuada protecci??n la colocaci??n de dos dosis, la segunda se coloca 21 d??as despu??s de la primera. Los pa??ses que actualmente vienen recibiendo la vacuna son: China, Los Emiratos ??rabes Unidos, Bahr??in, Egipto y Jordania. Se estima que en China m??s de 1 mill??n de personas ya la recibieron. La vacuna contra la SARS-CoV-2 (Vero Cell), inactivada est?? formulada con la cepa del SARSCoV-2 que es inoculada en las c??lulas vero para cultivo, cosecha del virus, inactivaci??n- ??propiolactona, concentraci??n y purificaci??n. Luego, es absorbida con adyuvante de aluminio para formar la vacuna l??quida. Los adyuvantes estimulan el sistema inmunol??gico para estimular su respuesta a una vacuna. Los virus inactivados se han utilizado durante m??s de un siglo. Jonas Salk los utiliz?? para crear su vacuna contra la polio en la d??cada de 1950, y son las bases para las vacunas contra otras enfermedades, incluyendo la rabia y la hepatitis A. Esta vacuna es de colocaci??n intramuscular en el hombro (musculo deltoides). Todav??a no se puede establecer la duraci??n de la protecci??n. Es posible que el nivel de anticuerpos disminuya en el transcurso de meses. Pero el sistema inmunol??gico tambi??n contiene c??lulas especiales llamadas c??lulas B de memoria que pueden retener informaci??n sobre el coronavirus durante a??os o incluso d??cadas. Los efectos secundarios presentados por los vacunados son:
                    </p>
                    <p class="text-justify">
                        (1)	Muy com??n (> 10%): dolor en el lugar donde se aplic?? la inyecci??n.
                    </p>
                    <p class="text-justify">
                        (2)	Com??n (1% - 10%): fiebre temporal, fatiga, dolor de cabeza, diarrea, enrojecimiento, hinchaz??n, picaz??n y endurecimiento en el lugar donde se aplic?? la inyecci??n
                    </p>
                    <p class="text-justify">
                        (3)	Raro (&lt;1%): Sarpullido de la piel en el lugar donde se aplic?? la inyecci??n; n??useas y v??mitos, picaz??n en el lugar donde no se aplic?? la inyecci??n, dolor muscular, artralgia, somnolencia, mareos.
                    </p>
                    <p class="text-justify">
                        (4)	Serias: no se han observado reacciones serias, con relaci??n a esta vacuna. Generalmente las reacciones se resuelven en las primeras 48 a 72 horas posterior a la vacunaci??n. Posterior a la vacunaci??n ud. se quedar?? 30 minutos en observaci??n, para posteriormente retirarse.
                    </p>
                    <p class="text-justify">
                        Los efectos secundarios presentados por los vacunados principalmente son en el lugar de la aplicaci??n de la vacuna como: dolor, ligera hinchaz??n, enrojecimiento. As?? mismo, se han reportado algunas reacciones sist??micas como dolor de cabeza, malestar general, dolores musculares o cansancio. Dichas reacciones se resuelven o pasan entre 48 a 72 horas de vacunado.
                    </p>
                    <p>
                        <b>
                            Recomendaciones: En caso presentara molestia, debe acercarse inmediatamente al establecimiento de salud m??s cercano para ser evaluado (a).
                        </b>
                    </p>
                </td>
            </tr>
        
            
        </table>
    </div> 
    <div style="page-break-before: always;"></div>
    <div class="content">
        <table class="w-full">
            <tr>
                <td style="text-align: left">
                    <img src="{{public_path('images/logo-essalud.png')}}" style="max-width: 100px" alt="">
                </td>
                <td style="text-align: right">
                    
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <p>???Decenio de la igualdad de oportunidades para mujeres y hombres???</p>
                    <p>???A??o de bicentenario del Per??: 200 a??os de independencia???</p>
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <p style="font-size: 16px; margin-top:2px; margin-bottom:10px; font-weight:bold">EXPRESI??N DE CONSENTIMIENTO INFORMADO</p>
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
                                <div class="linea_bottom" style="width:390px">{{$nombre_sp}}</div>
                                <div class="no_line_botton">con DNI </div>
                                <div class="linea_bottom" style="width: 112px; text-align: center;">{{$campo_documento}}</div>
                            </td>
                        </tr>
                    </table>
                  
                    
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="mt-3 text-justify">Declaro haber sido informado(a) de los beneficios y los potenciales efectos adversos de la Vacuna contra la COVID 19 y resueltas todas las preguntas y dudas al respecto, consciente de mis derechos y en forma voluntaria, en cumplimiento de la Resoluci??n Ministerial N??848-2020/MINSA; 
                    </p>
                    <p>SI (
                            @if($sin_documento2_pre1=='SI')
                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                            @endif
                        ) 
                        NO (
                            @if($sin_documento2_pre1=='NO')
                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                            @endif
                        ) doy mi consentimiento para que el personal de salud, me apliquen la vacuna contra el COVID 19.
                    </p>
                    <p class="text-justify">
                        SI (
                            @if($sin_documento2_pre2=='SI')
                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                            @endif 
                        ) NO (
                            @if($sin_documento2_pre2=='NO')
                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                            @endif
                        ) Tengo comorbilidades que priorizan mi vacunaci??n
                    </p>
                    <p class="text-justify">
                    SI (
                        @if($sin_documento2_pre3=='SI')
                            <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                            @endif
                    ) NO (
                        @if($sin_documento2_pre3=='NO')
                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                        @endif
                    ) Tengo comorbilidades que contraindican la vacunaci??n
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
                        </tr>
                        <tr>
                            <td width="50%" style="padding-right: 20px">
                            
                                <p class="sub">Firma o huella digital del paciente o representante legal</p>
                                <p class="mt-3">
                                    <div class="no_line_botton">DNI N?? </div> 
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
                                    <div class="no_line_botton">DNI N?? </div> 
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
                            
                                <p class="sub">Firma o huella digital del paciente o representante legal</p>
                                <p class="mt-3">
                                  
                                    <div class="no_line_botton">DNI N?? </div> 
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
                                    <div class="no_line_botton">DNI N?? </div> 
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
    <div style="page-break-before: always;"></div>
    <div class="content">
        <table class="w-full">
            <tr>
                <td style="text-align: left">
                    <img src="{{public_path('images/logo-essalud.png')}}" style="max-width: 100px" alt="">
                </td>
                <td style="text-align: right">
                    
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <p>???Decenio de la igualdad de oportunidades para mujeres y hombres???</p>
                    <p>???A??o de bicentenario del Per??: 200 a??os de independencia???</p>
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <p style="font-size: 16px; margin-top:2px; margin-bottom:10px; font-weight:bold">
                        FORMATO DE CONSENTIMIENTO INFORMADO PARA APLICACI??N DE LA VACUNA CONTRA LA COVID-19</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table">
                        <tr>
                            <td width="40%">
                                <p class="header">DIRIS / GERESA / DIRESA</p>
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
                <td colspan="2">
                    <div class="w-full">
                        <table class="table">
                          
                            <tbody>
                                <tr>
                                    <td width="76%" class="header">Preguntas de detecci??n de COVID-19</td>
                                    <td width="40px" class="header">SI</td>
                                    <td width="40px" class="header">NO</td>
                                </tr>
                                <tr>
                                    <td>
                                        1. En las ??ltimas dos semanas, ??ha dado positivo en COVID-19 o actualmente est?? siendo monitoreado por COVID-19?
                                    </td>
                                    <td class="center" valign="middle" width="40px" style="text-align: center">
                                        @if($sin_documento3_pre1=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" width="40px" style="text-align: center">
                                        @if($sin_documento3_pre1=='NO')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        2. En las ??ltimas semanas, ??ha tenido contacto con alguien que dio positivo en COVID-19? ??Est?? en cuarentena?
                                    </td>
                                    <td class="center" valign="middle" style="text-align: center">
                                        @if($sin_documento3_pre2=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" style="text-align: center">
                                        @if($sin_documento3_pre2=='NO')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        3. ??Tiene actualmente o ha tenido en los ??ltimos 14 d??as fiebre, escalofr??os, tos, dificultad para respirar, falta de aire, fatiga, dolores musculares o corporales, dolor de cabeza, p??rdida del gusto y del olfato, dolor de garganta , n??useas, v??mitos o diarrea?, ??Ha recibido plasma de paciente convaleciente?
                                    </td>
                                    <td class="center" valign="middle" style="text-align: center">
                                        @if($sin_documento3_pre3=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" style="text-align: center">
                                        @if($sin_documento3_pre3=='NO')
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
                <td colspan="2">
                    <div class="w-full">
                        <table class="table">
                          
                            <tbody>
                                <tr>
                                    <td width="76%" class="header">Preguntas de detecci??n previas a la inmunizaci??n</td>
                                    <td width="30px" class="header">SI</td>
                                    <td width="30px" class="header">NO</td>
                                </tr>
                                <tr>
                                    <td class="text-sm">
                                        1. ??Est?? enfermo hoy? (Por ejemplo, ??tiene fiebre, un resfriado o congesti??n?) ??Tiene usted un problema de sangrado o est?? tomando medicamentos para adelgazar o hematol??gico?
                                    </td>
                                    <td class="center" valign="middle" width="30px" style="text-align: center">
                                        @if($documento3_pre1=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" width="30px" style="text-align: center">
                                        @if($documento3_pre1=='NO')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="text-sm">
                                        2. ??Padece de alergias o reacciones leves o moderadas a alg??n alimento, medicamento, vacuna o l??tex? (Por ejemplo, huevos, gelatina, neomicina, timerosal, etc.)
                                    </td>
                                    <td class="center" valign="middle" style="text-align: center">
                                        @if($documento3_pre2=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" style="text-align: center">
                                        @if($documento3_pre2=='NO')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">
                                        3. ??Alguna vez tuvo una reacci??n grave despu??s de recibir una vacuna? ??Ha sufrido desmayos con frecuencia, particularmente despu??s de vacunarse? ??Alguna vez un m??dico u otro profesional de atenci??n m??dica le ha advertido sobre la posibilidad de recibir determinadas vacunas o recibirlas fuera de un entorno m??dico?

                                    </td>
                                    <td class="center" valign="middle" style="text-align: center">
                                        @if($documento3_pre3=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" style="text-align: center">
                                        @if($documento3_pre3=='NO')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">
                                        4. ??Ha recibido alguna vacuna o le han realizado una prueba cut??nea de tuberculosis en las ??ltimas 4 semanas? ??Recibir?? alguna vacuna en las pr??ximas 4 semanas?

                                    </td>
                                    <td class="center" valign="middle" style="text-align: center">
                                        @if($documento3_pre4=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" style="text-align: center">
                                        @if($documento3_pre4=='NO')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">
                                        5. En los ??ltimos 90 d??as, ??ha recibido una transfusi??n de sangre o productos derivados de la sangre, incluido plasma de convaleciente?
                                    </td>
                                    <td class="center" valign="middle" style="text-align: center">
                                        @if($documento3_pre5=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" style="text-align: center">
                                        @if($documento3_pre5=='NO')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">
                                        6. ??Tiene c??ncer, leucemia, virus de inmunodeficiencia humana (HIV)/s??ndrome de inmunodeficiencia adquirida (AIDS), artritis reumatoide, espondilitis anquilosante, enfermedad de Crohn o cualquier otro problema del sistema inmunitario?

                                    </td>
                                    <td class="center" valign="middle" style="text-align: center">
                                        @if($documento3_pre6=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" style="text-align: center">
                                        @if($documento3_pre6=='NO')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">
                                        7. ??Su sistema inmunitario est?? debilitado o, en los ??ltimos 3 meses, ha tomado medicamentos que lo debiliten, como cortisona, prednisona, otros esteroides o medicamentos contra el c??ncer? ??Ha recibido un tratamiento de radiaci??n?

                                    </td>
                                    <td class="center" valign="middle" style="text-align: center">
                                        @if($documento3_pre7=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" style="text-align: center">
                                        @if($documento3_pre7=='NO')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">
                                        8. Para la mujer, ??est?? embarazada o hay alguna posibilidad de que quede embarazada durante el pr??ximo mes? ??Actualmente est?? amamantando?

                                    </td>
                                    <td class="center" valign="middle" style="text-align: center">
                                        @if($documento3_pre8=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" style="text-align: center">
                                        @if($documento3_pre8=='NO')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-sm">
                                        9. ??Es su segunda dosis? ??Qu?? vacuna recibi???
                                    </td>
                                    <td class="center" valign="middle" style="text-align: center">
                                        @if($documento3_pre9=='SI')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                    <td class="center" valign="center" style="text-align: center">
                                        @if($documento3_pre9=='NO')
                                        <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <div class="tobottom">
            <hr>
            <p style="font-size: 10px">* ACIP: Advisory Committee on Inmunization Practices</p>
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
                    
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <p>???Decenio de la igualdad de oportunidades para mujeres y hombres???</p>
                    <p>???A??o de bicentenario del Per??: 200 a??os de independencia???</p>
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <p style="font-size: 16px; margin-top:2px; margin-bottom:10px; font-weight:bold">
                        VACUNACI??N CONTRA EL COVID 19 EN EL SEGURO SOCIAL DE SALUD</p>
                </td>
            </tr>
            <tr>
                <td class="text-left" colspan="2">
                    <p style="font-size: 16px; margin-top:2px; margin-bottom:10px; font-weight:bold">
                        TRIAJE COVID</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table" border="0" cellpadding="5" cellspacing="10">
                        <tr>
                            <td width="15%">
                                <p class="text-center">1</p>
                            </td>
                            <td width="55%">
                                <p class="text-left">??Tiene alguna enfermedad cr??nica?</p>
                            </td>
                            <td width="15%" class="text-center">
                                
                                @if($documento4_pre1=='NO')
                                <img src="{{public_path('images/no_mark.svg')}}"  alt="">
                                @else
                                <img src="{{public_path('images/no.svg')}}"  alt="">
                                @endif
                            </td>
                            <td width="15%" class="text-center">
                                @if($documento4_pre1=='SI')
                                <img src="{{public_path('images/si_mark.svg')}}" style="max-width:20px" alt="">
                                @else
                                <img src="{{public_path('images/si.svg')}}" alt="">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">
                                <p class="text-center">2</p>
                            </td>
                            <td width="55%">
                                <p class="text-left">??Ha tenido antes una reacci??n importante a alguna vacuna?</p>
                            </td>
                            <td width="15%" class="text-center">
                                
                                @if($documento4_pre2=='NO')
                                <img src="{{public_path('images/no_mark.svg')}}"  alt="">
                                @else
                                <img src="{{public_path('images/no.svg')}}"  alt="">
                                @endif
                            </td>
                            <td width="15%" class="text-center">
                                @if($documento4_pre2=='SI')
                                <img src="{{public_path('images/si_mark.svg')}}" style="max-width:20px" alt="">
                                @else
                                <img src="{{public_path('images/si.svg')}}" alt="">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">
                                <p class="text-center">3</p>
                            </td>
                            <td width="55%">
                                <p class="text-left">??Tiene leucemia, c??ncer o alguna otra enfermedad que afecte a la inmunidad?</p>
                            </td>
                            <td width="15%" class="text-center">
                                
                                @if($documento4_pre3=='NO')
                                <img src="{{public_path('images/no_mark.svg')}}"  alt="">
                                @else
                                <img src="{{public_path('images/no.svg')}}"  alt="">
                                @endif
                            </td>
                            <td width="15%" class="text-center">
                                @if($documento4_pre3=='SI')
                                <img src="{{public_path('images/si_mark.svg')}}" style="max-width:20px" alt="">
                                @else
                                <img src="{{public_path('images/si.svg')}}" alt="">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">
                                <p class="text-center">4</p>
                            </td>
                            <td width="55%">
                                <p class="text-left">??Ha recibido tratamiento continuo los ??ltimos 15 d??as o transfusiones de sangre o derivados, los ??ltimos 15 meses?</p>
                            </td>
                            <td width="15%" class="text-center">
                                
                                @if($documento4_pre4=='NO')
                                <img src="{{public_path('images/no_mark.svg')}}"  alt="">
                                @else
                                <img src="{{public_path('images/no.svg')}}"  alt="">
                                @endif
                            </td>
                            <td width="15%" class="text-center">
                                @if($documento4_pre4=='SI')
                                <img src="{{public_path('images/si_mark.svg')}}" style="max-width:20px" alt="">
                                @else
                                <img src="{{public_path('images/si.svg')}}" alt="">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">
                                <p class="text-center">5</p>
                            </td>
                            <td width="55%">
                                <p class="text-left">??Convive con personas de edad avanzada o alguna persona con c??ncer, trasplantes, recibe quimioterapia u otra circunstancia que afecte a la inmunidad?</p>
                            </td>
                            <td width="15%" class="text-center">
                                
                                @if($documento4_pre5=='NO')
                                <img src="{{public_path('images/no_mark.svg')}}"  alt="">
                                @else
                                <img src="{{public_path('images/no.svg')}}"  alt="">
                                @endif
                            </td>
                            <td width="15%" class="text-center">
                                @if($documento4_pre5=='SI')
                                <img src="{{public_path('images/si_mark.svg')}}" style="max-width:20px" alt="">
                                @else
                                <img src="{{public_path('images/si.svg')}}" alt="">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">
                                <p class="text-center">6</p>
                            </td>
                            <td width="55%">
                                <p class="text-left">??Apto para vacunarse?</p>
                            </td>
                            <td width="15%" class="text-center">
                                
                                @if($documento4_pre6=='NO')
                                <img src="{{public_path('images/no_mark.svg')}}"  alt="">
                                @else
                                <img src="{{public_path('images/no.svg')}}"  alt="">
                                @endif
                            </td>
                            <td width="15%" class="text-center">
                                @if($documento4_pre6=='SI')
                                <img src="{{public_path('images/si_mark.svg')}}"  alt="">
                                @else
                                <img src="{{public_path('images/si.svg')}}" alt="">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">
                                <p class="text-center">7</p>
                            </td>
                            <td width="55%">
                                <p class="text-left">??Es al??rgico a alg??n medicamento (neomicina o estreptomicina)?</p>
                            </td>
                            <td width="15%" class="text-center">
                                
                                @if($documento4_pre7=='NO')
                                <img src="{{public_path('images/no_mark.svg')}}"  alt="">
                                @else
                                <img src="{{public_path('images/no.svg')}}"  alt="">
                                @endif
                            </td>
                            <td width="15%" class="text-center">
                                @if($documento4_pre7=='SI')
                                <img src="{{public_path('images/si_mark.svg')}}" alt="">
                                @else
                                <img src="{{public_path('images/si.svg')}}" alt="">
                                @endif
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