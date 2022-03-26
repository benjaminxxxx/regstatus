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

<x-form-modal submit="mostrarElConsentimiento14a" wire:model="mostrarconsentimiento" maxWidth="5xl">
    <x-slot name="title">
        &nbsp;
    </x-slot>

    
    
    <x-slot name="content">
        <div class="px-2 md:px-14">
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
                                        <td class="center" valign="middle">
                                            <input type="radio" required wire:model="documento1_pre1" name="doc1pre1" value="SI">
                                        </td>
                                        <td class="center" valign="center">
                                            <input type="radio" wire:model="documento1_pre1" name="doc1pre1" value="NO">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            2. En las últimas semanas, ¿ha tenido contacto con alguien que dio positivo en COVID-19? ¿Está en cuarentena?
                                        </td>
                                        <td class="center" valign="middle">
                                            <input type="radio" required wire:model="documento1_pre2" name="doc1pre2" value="SI">
                                        </td>
                                        <td class="center" valign="center">
                                            <input type="radio" wire:model="documento1_pre2" name="doc1pre2" value="NO">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3. ¿ Tiene actualmente o ha tenido en los últimos 14 días fiebre, escalofríos, tos, dificultad para respirar, falta de aire, fatiga, dolores musculares o corporales, dolor de cabeza, pérdida del gusto y del olfato, dolor de garganta , náuseas, vómitos o diarrea?
                                        </td>
                                        <td class="center" valign="middle">
                                            <input type="radio" required wire:model="documento1_pre3" name="doc1pre3" value="SI">
                                        </td>
                                        <td class="center" valign="center">
                                            <input type="radio" wire:model="documento1_pre3" name="doc1pre3" value="NO">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            SI LA RESPUESTA A ALGUNA DE LAS PREGUNTAS ES SÍ, SE POSTERGA LA VACUNACIÓN. HASTA 90 DÍAS DESPUÉS DEL ALTA EN LOS CASOS DE LA PREGUNTA 1 Y 3. 14 DÍAS DESPUES DE CULMINADA SU CUARENTENA EN EL CASO DE LA PREGUNTA 2.
                           
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </x-slot>
    <x-slot name="footer">
        <x-secondary-button type="button" wire:click.pevent="$toggle('mostrarconsentimiento')" wire:loading.attr="disabled">
            CANCELAR
        </x-secondary-button>
        <x-button type="submit" wire:loading.attr="disabled">
            SIGUIENTE
        </x-button>
    </x-slot>
</x-form-modal>
