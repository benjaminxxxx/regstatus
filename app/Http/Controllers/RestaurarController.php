<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Documento2;
use App\Models\Pacientes2;
use App\Imports\PacientesImport;
use DB;
use PDF;
use File;

class RestaurarController extends Controller
{
    //
    public $last_triador_nombre = 'MARLENE YRIS YAURI HERNANDEZ';
    public $last_triador_dni = '09773784';
    public $last_triador_firma = 'enfermero_614ddc1b1213c___MARLENE%20YRIS%20YAURI%20HERNANDEZ.jpeg';

    public function index(Request $request){

        
        $puederestaurar = false;
        $fecha = '';

        $selectAll = DB::select('SELECT fecha, count(id) as total FROM `pacientes2` group by (fecha)');
        

        if($request->has('fecha')){
            $puederestaurar = true;
            $fecha = $request->fecha;
            $dataPacientes = Pacientes2::where(['fecha'=>$request->fecha])->with(['documentos'])->get();

            if($request->has('restaurar')){
                $this->restaurar($request->fecha);
            }
        }else{
            $dataPacientes = Pacientes2::limit(10)->get();
        }

        return view('restaurar.index',[
            'pacientes'=>$dataPacientes,
            'puederestaurar'=>$puederestaurar,
            'fecha'=>$fecha,
            'total'=>$selectAll
        ]);

    }
    public function restaurar(Request $request){
        //$dataPacientes = Pacientes2::where(['fecha'=>$request->fecha])->with(['documentos'])->get();
        $personasMax100 = 0;

        if($request->has('fecha') && trim($request->fecha)!=''){

            $fecha = trim($request->fecha);

            if($request->has('skip')){

                $resultPart = [];
                
                $skip = $request->skip;

                $usuariosAtendidos = Pacientes2::skip($skip)->take(5)->where([
                    ['fecha','=',$fecha]
                ])->get();
                if($usuariosAtendidos!=null){
                    if($usuariosAtendidos->count()>0){
                        foreach ($usuariosAtendidos as $usuarioAtendido) {
                            /*$resultPart[] = [
                                'id'=>$usuarioAtendido->id,
                                'nombres'=>$usuarioAtendido->nombres
                            ];*/
                            //buscar si existe registro de documento
                            $this->restoreDocument($usuarioAtendido);
                        }
                    }
                }
                return json_encode(['usuarios'=>$resultPart]);
            }else{
                session()->put('total_recuperados',0);
            }

            if($fecha!=''){

                $personasMax100 = Pacientes2::where([
                    ['fecha','=',$fecha]
                ])->get()->count();
            }
        }

        return json_encode(['total'=>$personasMax100]);
    }
    public function restoreDocument(Pacientes2 $paciente){
        $marca = $paciente->marca;

        //MARCA NULL O PHIZER
        if($marca=='' || $marca==null || $marca=='PFIZER'){
            $marca = '';

            $this->generarDocumentos1($paciente);
        }
        if($marca=='SINOPHARM'){

            $this->generarDocumentos1($paciente);//$this->generarDocumentos2($paciente);
        }

    }
    //SINOPAHARM
    public function generarDocumentos2(Pacientes2 $paciente){

        //extraer datos del triador
        $usertriaje = User::where(['name'=>$paciente->triaje])->first();

        $triador_nombre=$this->last_triador_nombre;
        $triador_dni=$this->last_triador_dni;
        $triador_firma=$this->last_triador_firma;

        if($usertriaje){
            $triador_nombre=$paciente->triaje;
            $triador_dni=$usertriaje->dni;
            $triador_firma=$usertriaje->firma;
        }

        $data = [
            'documento1_redgerencia' => 'ALMENARA',
            'documento1_establecimiento' => 'SAN ISIDRO LABRADOR',
            'nombres' => $paciente->nombres,
            'edad' => $paciente->edad,
            'documento' => $paciente->dni,
            'telefono' => '-',
            'domicilio' => '-',
            'archivosAdjuntos' => null,
            'sin_documento2_pre1'=>'SI',
            'sin_documento2_pre2'=>'NO',
            'sin_documento2_pre3'=>'NO',
            'sin_documento3_pre1'=>'NO',
            'sin_documento3_pre2'=>'NO',
            'sin_documento3_pre3'=>'NO',
            
            'documento3_pre1'=>'NO',
            'documento3_pre2'=>'NO',
            'documento3_pre3'=>'NO',
            'documento3_pre4'=>'NO',
            'documento3_pre5'=>'NO',
            'documento3_pre6'=>'NO',
            'documento3_pre7'=>'NO',
            'documento3_pre8'=>'NO',
            'documento3_pre9'=>'NO',

            'documento4_pre1'=>'NO',
            'documento4_pre2'=>'NO',
            'documento4_pre3'=>'NO',
            'documento4_pre4'=>'NO',
            'documento4_pre5'=>'NO',
            'documento4_pre6'=>'NO',
            'documento4_pre7'=>'NO',

            'firmaConsentimiento1'=>'firma_vacia.png',
            'firmaConsentimiento2'=>'firma_vacia.png',
            'firmaDesistimiento'=>NULL,
            'companion_tipodocumento'=>NULL,
            'companion_documento'=>NULL,
            'companion_telefono'=>NULL,
            'companion_nombres'=>NULL,
            'companion_tipo'=>NULL,
            'firmartraije'=>'consentimiento',
            'triador_nombre'=>$triador_nombre,
            'triador_dni'=>$triador_dni,
            'triador_firma'=>$triador_firma,
            'fecha'=>$paciente->fecha,
            'hora'=>$paciente->horatriaje,
        ];

        $nombreSede = 'ALMENARA - SAN ISIDRO LABRADOR';
 
        
        $customPaper = array(0,0,595.28,841.89);

        $fecha_dir = $paciente->fecha;
            
        if(!file_exists('docs/restaurados/' . $fecha_dir)){
            File::makeDirectory('docs/restaurados/' . $fecha_dir . '/');
        }

        $documento_nombre_1 = $fecha_dir . '/' . $nombreSede . ' - ' . $paciente->nombres . ' - CONSENTIMIENTO.pdf';

        if(!file_exists(public_path('docs/restaurados/' . $documento_nombre_1))){

            $pdf_documento1 = PDF::loadView('snippets.consentimientosin_mix_pdf_rest', $data)
            ->setPaper($customPaper)->save('docs/restaurados/' . $documento_nombre_1);

            ///$paciente = UsuarioAtendido::find($this->registro_id);


            if($paciente->documentos()->count()>0){
                //update
                Documento2::where(['usuariosatendido_id'=>$paciente->id])->update([
                    'documento_nombre_1'=>$documento_nombre_1,
                ]);
            }else{
                $paciente->documentos()->create([
                    'documento_nombre_1'=>$documento_nombre_1,
                ]); 
            }
        }
        
        $total_recuperados_anterior = session()->get('total_recuperados');

        if(!$total_recuperados_anterior){
            $total_recuperados_anterior = 0;
        }
        $total_recuperados_anterior+=1;
        session()->put('total_recuperados',$total_recuperados_anterior);
     
    }
    public function generarDocumentos1(Pacientes2 $paciente){

        //extraer datos del triador
        $usertriaje = User::where(['name'=>$paciente->triaje])->first();

        $triador_nombre=$this->last_triador_nombre;
        $triador_dni=$this->last_triador_dni;
        $triador_firma=$this->last_triador_firma;

        if($usertriaje){
            $triador_nombre=$paciente->triaje;
            $triador_dni=$usertriaje->dni;
            $triador_firma=$usertriaje->firma;
        }

        $data = [
            'documento1_redgerencia' => 'ALMENARA',
            'documento1_establecimiento' => 'SAN ISIDRO LABRADOR',
            'nombres' => $paciente->nombres,
            'edad' => $paciente->edad,
            'documento' => $paciente->dni,
            'telefono' => '-',
            'domicilio' => '-',
            'archivosAdjuntos' => null,
            'documento1_pre1'=>'NO',
            'documento1_pre2'=>'NO',
            'documento1_pre3'=>'NO',
            'documento2_pre1'=>'NO',
            'documento2_pre2'=>'NO',
            'documento2_pre3'=>'SI',
            'firmaConsentimiento1'=>'firma_vacia.png',
            'firmaConsentimiento2'=>'firma_vacia.png',
            'firmaDesistimiento'=>NULL,
            'companion_tipodocumento'=>NULL,
            'companion_documento'=>NULL,
            'companion_telefono'=>NULL,
            'companion_nombres'=>NULL,
            'companion_tipo'=>NULL,
            'firmartraije'=>'consentimiento',
            'triador_nombre'=>$triador_nombre,
            'triador_dni'=>$triador_dni,
            'triador_firma'=>$triador_firma,
            'fecha'=>$paciente->fecha,
            'hora'=>$paciente->horatriaje,
        ];

        $nombreSede = 'ALMENARA - SAN ISIDRO LABRADOR';
 
        
        $customPaper = array(0,0,595.28,841.89);

        $fecha_dir = $paciente->fecha;
            
        if(!file_exists('docs/restaurados/' . $fecha_dir)){
            File::makeDirectory('docs/restaurados/' . $fecha_dir . '/');
        }

        $documento_nombre_1 = $fecha_dir . '/' . $nombreSede . ' - ' . $paciente->nombres . ' - CONSENTIMIENTO.pdf';

        if(!file_exists(public_path('docs/restaurados/' . $documento_nombre_1))){

            $pdf_documento1 = PDF::loadView('snippets.consentimiento_mix_pdf_rest', $data)
            ->setPaper($customPaper)->save('docs/restaurados/' . $documento_nombre_1);

            ///$paciente = UsuarioAtendido::find($this->registro_id);


            if($paciente->documentos()->count()>0){
                //update
                Documento2::where(['usuariosatendido_id'=>$paciente->id])->update([
                    'documento_nombre_1'=>$documento_nombre_1,
                ]);
            }else{
                $paciente->documentos()->create([
                    'documento_nombre_1'=>$documento_nombre_1,
                ]); 
            }
        }
        
        $total_recuperados_anterior = session()->get('total_recuperados');

        if(!$total_recuperados_anterior){
            $total_recuperados_anterior = 0;
        }
        $total_recuperados_anterior+=1;
        session()->put('total_recuperados',$total_recuperados_anterior);
     
    }
    public function cargardata(Request $request){
        try {
            if(!$request->has('data')) die('No hay archivo seleccionado');

            $path1 = $request->data->store('temp'); 
            $path = storage_path('app').'/'.$path1;  
            $data = \Excel::import(new PacientesImport,$path);

            return back()->with('success', 'Carga correcta!');

        } catch (\Throwable $th) {
            
            return back()->withErrors($th->getMessage());

        }

    }

}
