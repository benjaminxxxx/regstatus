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

    $arrQuestions3 = [
        '1'=>'1. ??Est?? enfermo hoy? (Por ejemplo, ??tiene fiebre, un resfriado o congesti??n?) ??Tiene usted un problema de sangrado o est?? tomando medicamentos para adelgazar o hematol??gico?',
        '2'=>'2. ??Padece de alergias o reacciones leves o moderadas a alg??n alimento, medicamento, vacuna o l??tex? (Por ejemplo, huevos, gelatina, neomicina, timerosal, etc.)',
        '3'=>'3. ??Alguna vez tuvo una reacci??n grave despu??s de recibir una vacuna? ??Ha sufrido desmayos con frecuencia, particularmente despu??s de vacunarse? ??Alguna vez un m??dico u otro profesional de atenci??n m??dica le ha advertido sobre la posibilidad de recibir determinadas vacunas o recibirlas fuera de un entorno m??dico?',
        '4'=>'4. ??Ha recibido alguna vacuna o le han realizado una prueba cut??nea de tuberculosis en las ??ltimas 4 semanas? ??Recibir?? alguna vacuna en las pr??ximas 4 semanas?',
        '5'=>'5. En los ??ltimos 90 d??as, ??ha recibido una transfusi??n de sangre o productos derivados de la sangre, incluido plasma de convaleciente?',
        '6'=>'6. ??Tiene c??ncer, leucemia, virus de inmunodeficiencia humana (HIV)/s??ndrome de inmunodeficiencia adquirida (AIDS), artritis reumatoide, espondilitis anquilosante, enfermedad de Crohn o cualquier otro problema del sistema inmunitario?',
        '7'=>'7. ??Su sistema inmunitario est?? debilitado o, en los ??ltimos 3 meses, ha tomado medicamentos que lo debiliten, como cortisona, prednisona, otros esteroides o medicamentos contra el c??ncer? ??Ha recibido un tratamiento de radiaci??n?',
        '8'=>'8. Para la mujer, ??est?? embarazada o hay alguna posibilidad de que quede embarazada durante el pr??ximo mes? ??Actualmente est?? amamantando?',
        '9'=>'9. ??Es su segunda dosis? ??Qu?? vacuna recibi???',
    ]; 
    $arrQuestions4  = [
        '1'=>'??Tiene alguna enfermedad cr??nica?',
        '2'=>'??Ha tenido antes una reacci??n importante a alguna vacuna?',
        '3'=>'??Tiene leucemia, c??ncer o alguna otra enfermedad que afecte a la inmunidad?',
        '4'=>'??Ha recibido tratamiento continuo los ??ltimos 15 d??as o transfusiones de sangre o derivados, los ??ltimos 15 meses?',
        '5'=>'??Convive con personas de edad avanzada o alguna persona con c??ncer, trasplantes, recibe quimioterapia u otra circunstancia que afecte a la inmunidad?',
        '6'=>'??Apto para vacunarse?',
        '7'=>'??Es al??rgico a alg??n medicamento (neomicina o estreptomicina)?'
    ];
?>
<style>
    .title,.content{
        font-weight: bold;
        font-size: 16px;
        text-align: center;
        width: 100%;
        font-family: Arial;
        max-width: 669px;
        margin: 0 auto;
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
    /*
    .table td:nth-child(4) {
        width: 99px;
    }*/
    </style>
    
    <x-form-modal submit="procesaroSino" wire:model="mostrarconsentimientoSino" maxWidth="max-tablet">
        <x-slot name="title"></x-slot>
    
        
        
        <x-slot name="content">
            <div class="px-2 md:px-5 lg:px-5">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <img src="{{asset('images/logo-essalud.png')}}" class="h-8 mb-2" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <p>???Decenio de la igualdad de oportunidades para mujeres y hombres???</p>
                                <p>???A??o de bicentenario del Per??: 200 a??os de independencia???</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="title">ANEXO N?? 2</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="content text-sm py-2">Formato de Consentimiento informado para la Vacunaci??n contra la COVID-19</p>
                                <p class="content">HOJA INFORMATIVA SOBRE LA VACUNA CONTRA LA COVID-19 (LABORATORIO SINOPHARM)</p>
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
                                <p>???Decenio de la igualdad de oportunidades para mujeres y hombres???</p>
                                <p>???A??o de bicentenario del Per??: 200 a??os de independencia???</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="content py-4">EXPRESI??N DE CONSENTIMIENTO INFORMADO</p>
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
                                <p class="mt-3 text-justify">Declaro haber sido informado(a) de los beneficios y los potenciales efectos adversos de la Vacuna contra la COVID 19 y resueltas todas las preguntas y dudas al respecto, consciente de mis derechos y en forma voluntaria, en cumplimiento de la Resoluci??n Ministerial N??848-2020/MINSA; 
                                    SI (<span><input type="radio" required wire:model.defer="sin_documento2_pre1" name="doc2pre1" value="SI"></span>) 
                                    NO (<span><input type="radio" required wire:model.defer="sin_documento2_pre1" name="doc2pre1" value="NO"></span>) doy mi consentimiento para que el personal de salud, me apliquen la vacuna contra el COVID 19.
                                </p>
                                <p class="text-justify">
                                    SI (<span><input type="radio" required wire:model.defer="sin_documento2_pre2" name="doc2pre2" value="SI"></span>) NO (<span><input type="radio" required wire:model.defer="sin_documento2_pre2" name="doc2pre2" value="NO"></span>) Tengo comorbilidades que priorizan mi vacunaci??n
                                </p>
                                <p class="text-justify">
                                SI (<span><input type="radio" required wire:model.defer="sin_documento2_pre3" name="doc2pre3" value="SI"></span>) NO (<span><input type="radio" required wire:model.defer="sin_documento2_pre3" name="doc2pre3" value="NO"></span>) Tengo comorbilidades que contraindican la vacunaci??n
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
                                                    <div id="signaturesign4" style="max-width:298px;background: #efefef;"></div>
                                                </div>
                                                <div id="tools"></div>
                                            </div>
                                            <p class="sub">Firma o huella digital del paciente o representante legal</p>
                                            <p class="mt-3">DNI N?? <span class="understroke"><span class="firmap firmap1">{!!$campo_documento!!}</span></span></p>
                                        </td>
                                        <td width="45%">
                                            <div class="firma relative" style="min-height: 5rem">
                                                @if ($firmartraije=='consentimiento')
                                                    <img src="{{asset('firmas/'.Auth::user()->firma)}}" class="h-20 m-auto" alt="">
                                                @endif
                                                <input type="radio" wire:model="firmartraije" wire:change="getdoc1firmaSin('1')" name="firmartraije" class="absolute right-0 top-10" value="consentimiento">
                                            </div>
                                            <p class="sub withline">Firma y sello del personal de salud que informa y toma el consentimiento</p>
                                            <p class="mt-3">DNI N?? <span class="understroke"><span class="firmap firmap1">{!!$campo_documento_triaje!!}</span></span></p>
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
                                                    <div id="signaturesign5" style="max-width:298px;background: #efefef;"></div>
                                                </div>
                                                <div id="tools"></div>
                                            </div>
                                            <p class="sub">Firma o huella digital del paciente o representante legal</p>
                                            <p class="mt-3">DNI N?? <span class="understroke"><span class="firmap firmap2">{!!$campo_documento!!}</span></span></p>
                                        </td>
                                        <td width="45%">
                                            <div class="firma relative" style="min-height: 5rem">
                                                @if ($firmartraije=='desistimiento')
                                                    <img src="{{asset('firmas/'.Auth::user()->firma)}}" class="h-20 m-auto" alt="">
                                                @endif
                                                <input type="radio" wire:model="firmartraije" wire:change="getdoc1firmaSin('2')" name="firmartraije" class="absolute right-0 top-10" value="desistimiento">
                                            </div>
                                            <p class="sub withline">Firma y sello del personal de salud que informa y toma la revocatoria</p>
                                            <p class="mt-3">DNI N?? <span class="understroke"><span class="firmap firmap2">{!!$campo_documento_triaje!!}</span></span></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="px-2 md:px-14 mt-10">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <img src="{{asset('images/logo-essalud.png')}}" class="h-8 mb-2" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <p>???Decenio de la igualdad de oportunidades para mujeres y hombres???</p>
                                <p>???A??o de bicentenario del Per??: 200 a??os de independencia???</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="title py-2">FORMATO DE CONSENTIMIENTO INFORMADO PARA APLICACI??N DE LA VACUNA CONTRA LA COVID-19</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
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
                                            {{mb_strtoupper($documento1_redgerencia)}}
                                        </td>
                                        <td colspan="3">
                                            {{mb_strtoupper($documento1_establecimiento)}}
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
                                            {{mb_strtoupper($nombres)}}
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
                                            <th>Preguntas de detecci??n de COVID-19</th>
                                            <th width="40px">SI</th>
                                            <th width="40px">NO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                1. En las ??ltimas dos semanas, ??ha dado positivo en COVID-19 o actualmente est?? siendo monitoreado por COVID-19?
                                            </td>
                                            <td class="center" valign="middle">
                                                <input type="radio" required wire:model.defer="sin_documento3_pre1" name="sindoc3pre1" value="SI">
                                            </td>
                                            <td class="center" valign="center">
                                                <input type="radio" wire:model.defer="sin_documento3_pre1" name="sindoc3pre1" value="NO">
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>
                                                2. En las ??ltimas semanas, ??ha tenido contacto con alguien que dio positivo en COVID-19? ??Est?? en cuarentena?
                                            </td>
                                            <td class="center" valign="middle">
                                                <input type="radio" required wire:model.defer="sin_documento3_pre2" name="sindoc3pre2" value="SI">
                                            </td>
                                            <td class="center" valign="center">
                                                <input type="radio" wire:model.defer="sin_documento3_pre2" name="sindoc3pre2" value="NO">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3. ??Tiene actualmente o ha tenido en los ??ltimos 14 d??as fiebre, escalofr??os, tos, dificultad para respirar, falta de aire, fatiga, dolores musculares o corporales, dolor de cabeza, p??rdida del gusto y del olfato, dolor de garganta , n??useas, v??mitos o diarrea?, ??Ha recibido plasma de paciente convaleciente?
                                            </td>
                                            <td class="center" valign="middle">
                                                <input type="radio" required wire:model.defer="sin_documento3_pre3" name="sindoc3pre3" value="SI">
                                            </td>
                                            <td class="center" valign="center">
                                                <input type="radio" wire:model.defer="sin_documento3_pre3" name="sindoc3pre3" value="NO">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Preguntas de detecci??n previas a la inmunizaci??n</th>
                                            <th width="40px">SI</th>
                                            <th width="40px">NO</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($arrQuestions3 as $order3 => $arrQuestion3)
                                        <tr>
                                            <td>
                                                {{$arrQuestion3}}
                                            </td>
                                            <td class="center" valign="middle">
                                                <input type="radio" required wire:model.defer="documento3_pre{{$order3}}" name="doc3pre{{$order3}}" value="SI">
                                            </td>
                                            <td class="center" valign="center">
                                                <input type="radio" wire:model.defer="documento3_pre{{$order3}}" name="doc3pre{{$order3}}" value="NO">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                * ACIP: Advisory Committee on Inmunization Practices
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-2 md:px-14 mt-10">
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td>
                                <img src="{{asset('images/logo-essalud.png')}}" class="h-8 mb-2" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <p>???Decenio de la igualdad de oportunidades para mujeres y hombres???</p>
                                <p>???A??o de bicentenario del Per??: 200 a??os de independencia???</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="title py-2">VACUNACI??N CONTRA EL COVID 19 EN EL SEGURO SOCIAL DE SALUD</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>TRIAJE COVID</b>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table class="table" border="0" cellpadding="5" cellspacing="10">
                                    @foreach ($arrQuestions4 as $order4 => $arrQuestion4)
                                    <tr>
                                        <td width="15%">
                                            <p class="text-center">{{$order4}}</p>
                                        </td>
                                        <td width="55%">
                                            <p class="text-left">{{$arrQuestion4}}</p>
                                        </td>
                                        <td width="15%">
                                            <p class="text-center">No <input type="radio" required wire:model.defer="documento4_pre{{$order4}}" name="doc4pre{{$order4}}" value="NO"></p>
                                        </td>
                                        <td width="15%">
                                            <p class="text-center">Si <input type="radio" required wire:model.defer="documento4_pre{{$order4}}" name="doc4pre{{$order4}}" value="SI"></p>
                                        </td>
                                    </tr> 
                                    @endforeach
                                    
                                   
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button type="button" wire:click.pevent="$toggle('mostrarconsentimientoSino')" wire:loading.attr="disabled">
                CANCELAR
            </x-secondary-button>
            <x-button type="button" id="signature4">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white loading-docs hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>  PROCESAR DOCUMENTOS
            </x-button>
        </x-slot>
    </x-form-modal>
    