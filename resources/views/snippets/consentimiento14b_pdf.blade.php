@php
    $nombre_sp = mb_strtoupper($nombres);
  
    
    /*DOCUMENTO*/
    $campo_documento = mb_strtoupper($documento);
    $espacio_documento = 12 - strlen($campo_documento);

    if($espacio_documento<0){
        $espacio_documento = 0;
    }
    
    if($espacio_documento%2!=0){
        $espacio_documento++;
    }
    $totalporlado_documento = $espacio_documento / 2;

    $cantidad_adicional_documento = str_repeat('<span class="sp">&nbsp;</span>',$totalporlado_documento);

    $campo_documento=$cantidad_adicional_documento . $campo_documento . $cantidad_adicional_documento;

   
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
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<style>
    
@page {
    margin: 10px 10px 10px 10px !important;
    padding: 0px 0px 0px 0px !important;
}
html *{
    font-family: 'Roboto', sans-serif;
    font-size: 13px;
}
div.content{
    max-width: 620px;
    margin:0 auto;
}
.max-500{
    max-width: 560px;
    margin:0 auto;
}
.principal{
    
    width: 100%;
    
}
.title,.content,.title-spacer{
    font-weight: bold;
    font-size: 13px;
    text-align: center;
    width: 100%;
    max-width: 669px;
    margin: 0 auto;
}
p{
    padding: 0;
    margin: 0;
}
.table{
    width: 100%;
    margin-top:10px;
    table-layout: fixed
}
.table th,.table td{
    padding: 2px 5px;
    border:1px solid rgb(39, 39, 39) !important;
}
.table{border-collapse: collapse;}
th,.header{
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    text-align: center;
}
.table-layout{
    table-layout: fixed
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

.mt-2{
    margin-top:10px;
}
.mt-3{
    margin-top:10px;
}
.w-full{
    width: 100%
}
.tobottom{
    position: absolute;
    bottom: 0;
    text-align: left
}
.text-justify{
    text-align: justify;
    font-size:13px;
    margin-bottom: 6px;
    font-weight: 400;
}
.sub{
    position: relative;
    max-width: 296px;
    text-align: center;
    font-weight: normal;
}
.header2{
    font-size: 14px;
    text-align: left;
    font-weight: bold
}
.py-2{
    padding: 7px 0
}
.linea_dni{
    position: absolute; 
    left:40px;
}
.relative_linea{
    position: relative; 
    display: inline-block; 
    margin-top:7px;
}


</style>
</head>
<body>
    <div class="content">
        <table class="principal">
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
                <td colspan="2" class="text-center">
                    <div class="m-auto" style="width: auto; text-align:center">
                        <div class="firma">
                            <img src="{{public_path('firmas/'.$firmaConsentimiento2)}}" alt="">
                        </div>
                        <p class="sub m-auto text-center-important">Firma o huella digital del paciente o apoderado</p>
                        
                        <div class="relative_linea mt-3" style=" margin: 0 auto; max-width:200px">
                            <p >DNI N° {!!$campo_documento!!}</p>
                            <img src="{{public_path('images/linea_dni.png')}}" class="linea_dni" alt="">
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
    

</body>
</html>