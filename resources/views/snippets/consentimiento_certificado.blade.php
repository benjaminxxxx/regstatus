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
 
    @page { margin: 10px 70px 30px 70px !important; padding: 0px 0px 0px 0px !important; }
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
    div.content{ max-width: 700px; margin:0 auto; }
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
                    <img src="{{public_path('images/ministerio_salud.svg')}}" style="max-height: 40px; max-width:120px" alt="">
                </td>
                <td align="right">
                    <img src="{{public_path('images/pongoelhombro.svg')}}" style="max-height: 60px; max-width:120px" alt="">
                </td>
            </tr>
        </table>
        <table class="w-full">
            <tbody>
                
                <tr>
                    <td class="title">
                        <br>
                        <br>
                        CERTIFICADO DE VACUNACIÓN
                    </td>
                    
                </tr>
                <tr>
                    <td>
                        <table class="table">
                            <tr>
                                <td width="35%" colspan="2" class="header">
                                    PERSONA VACUNADA
                                </td>
                                <td  class="header">
                                    FECHA DE NACIMIENTO
                                </td>   
                                <td  class="header">
                                    EDAD
                                </td>
                                <td  class="header">
                                    CÓDIGO QR DE VALIDACIÓN
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p class="center">{{mb_strtoupper($nombres)}}</p>
                                </td>
                                <td>
                                    <p class="center">{{mb_strtoupper($fecha_nacimiento)}}</p>
                                </td>
                                <td>
                                    <p class="center">{{mb_strtoupper($edad)}}</p>
                                </td>
                                <td rowspan="4" class="center">
                                    <img src="{{public_path('images/qr.png')}}" style="max-width: 80px" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="header">
                                    Tipo de documento
                                </td>
                                <td colspan="2" class="header">
                                    Centro de vacunación
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="header">
                                    {{mb_strtoupper($tipodocumento)}}:{{mb_strtoupper($documento)}}
                                </td>
                                <td colspan="2" class="header">
                                    {{mb_strtoupper($nombre_sede)}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="left">
                                    Se aplicó: {{$dosis}} de 2
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" style="border-left:0; border-right:0">
                                    <br>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td class="header">
                                    FECHA DE VACUNACIÓN
                                </td>
                                <td class="header">
                                    DOSIS
                                </td>
                                <td class="header" colspan="2">
                                    FABRICANTE Y LOTE
                                </td>
                                <td class="header">
                                    VACUNADOR(A)
                                </td>
                            </tr>
                            <tr>
                                <td class="center">
                                    {{$fecha_vacunacion}}
                                </td>
                                <td class="center">
                                    {{$dosis}}
                                </td class="center">
                                <td colspan="2" class="center">
                                    {{$marca}} ({{$lote}})
                                </td>
                                <td class="center">
                                    <img src="{{public_path('firmas/' . $firma_vacunador)}}" style="max-width: 100px" alt="">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
              
            </tbody>
        </table>
        <div class="tobottom">
            <hr>
            <p style="font-size: 10px">{{mb_strtoupper('Este documento fué entregado en el centro de vacunación COVID 19 Hospital')}} {{mb_strtoupper($nombre_sede)}}</p>
        </div>
    </div>
  
</body>
</html>