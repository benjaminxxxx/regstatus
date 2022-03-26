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
</head>
<body>
    <style>
       *{
        font-family: 'Roboto', sans-serif;
       }

        table{border-collapse: collapse;}

        .title,.content{
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            width: 100%;
            max-width: 669px;
            margin: 0 auto;
        }
        .table{
            width: 100%;
            margin-top:20px;
        }
        .table th,.table td{
            border:1px solid rgb(39, 39, 39) !important;
            padding: 6px 7px;
        }
        th,.header{
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            text-align: center;
        }
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
        p{
            padding: 0;
            margin: 0;
        }
        .mt-2{
            margin-top:10px;
        }
        .w-full{
            width: 100%
        }
        /*
        .table td:nth-child(4) {
            width: 99px;
        }*/
        .tobottom{
            position: absolute;
            bottom: 0;
        }
        </style>
<div class="px-2">
   
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
                <td>
                    <p class="title">ANEXO N° 13</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="content">CRITERIOS DE ELIGIBILIDAD PARA EL PERSONAL DE SALUD PARA APLICACIÓN DE LA VACUNA CONTRA LA COVID-19</p>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Preguntas de detección de COVID-19</th>
                                <th width="40px">SI</th>
                                <th width="40px">NO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1. En las últimas dos semanas, ¿ha dado positivo en COVID-19 o actualmente está siendo monitoreado por COVID-19?
                                </td>
                                <td class="center" valign="middle" style="text-align: center">
                                    @if($documento1_pre1=='SI')
                                    <img src="{{public_path('images/check.png')}}" style="max-width:15px" alt="">
                                    @endif
                                </td>
                                <td class="center" valign="center" style="text-align: center">
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
        
</body>
</html>