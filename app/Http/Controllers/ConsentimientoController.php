<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Documento;
use App\Models\UsuarioAtendido;
use App\Models\Establecimiento;
use File;

class ConsentimientoController extends Controller
{
    //
    public function index(){

        if(Auth::user()->type!='administrador'){
            return view('error_',['message'=>'No tiene permiso a este panel']);
        }
        
        return view('consentimiento');
    }
    public function restaurar(Request $request){


        $personasMax100 = 0;

        if($request->has('fecha') && trim($request->fecha)!=''){

            $fecha = trim($request->fecha);

            if($request->has('skip')){

                $resultPart = [];
                
                $skip = $request->skip;

                $usuariosAtendidos = UsuarioAtendido::skip($skip)->take(100)->whereDate('fechahora','=',$fecha)->get();
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
            }

            if($fecha!=''){

                $personasMax100 = UsuarioAtendido::whereDate('fechahora','=',$fecha)->get()->count();
            }
        }

        return json_encode(['total'=>$personasMax100]);
    }
    public function restoreDocument(UsuarioAtendido $usuarioAtendido){
        
    }
    public function get(Request $request){

        try {
            $establecimientosObject = Establecimiento::where(['estado'=>'1'])->get();
            $arrEst = [];
            if($establecimientosObject->count()>0){
            
                $arrEst = $establecimientosObject->pluck('nombre','id')->all();
            }
        
            $establecimientos = $arrEst;

            $filter = [
                'estado'=>'vacunado'
            ];
            if($request->has('documento')){

                $documento = trim($request->documento);

                if(strlen($documento)>=7){
                    $filter['documento']=$documento;
                }
                
                
            }

            $usuariosatendidos = null;
            
            if($request->has('fecha') && trim($request->fecha)!=''){

                $fecha = trim($request->fecha);

                if($fecha!=''){
                    $usuariosatendidos = UsuarioAtendido::with('documentos')
                    ->whereDate('fechahora','=',$fecha)
                    ->where($filter)
                    ->orderBy('fechahora','desc')->get();
                }
            }else{
                
                $usuariosatendidos = UsuarioAtendido::with('documentos')
                ->where($filter)
                ->orderBy('fechahora','desc')->get();
            }


            return view('snippets.consentimiento_result',[
                'usuariosatendidos'=>$usuariosatendidos,
                'establecimientos'=>$establecimientos,
            ]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        
        
    }
    public function eliminar(Request $request){

     
        if($request->has('registrosseleccionados')){
            $RegistrosSeleccionados = json_decode($request->registrosseleccionados,true);
            
            $documentos = Documento::whereIn('usuariosatendido_id',$RegistrosSeleccionados)->get();
            if($documentos->count()>0){
                foreach ($documentos as $documento) {
                    $image_path = public_path("docs/" . $documento->documento_nombre_1);
                    $image_path2 = public_path("docs/" . $documento->documento_nombre_2);
    
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    if(File::exists($image_path2)) {
                        File::delete($image_path2);
                    }
    
                    Documento::find($documento->id)->delete();
                }
                return true;
            }else{
                dd('ninguno seleccionado: ' . $RegistrosSeleccionados);
            }
            
            
        }
        /*
        

        
        $this->RegistrosSeleccionados = [];
        $this->textoSeleccionarTodo = 'Seleccionar todo';*/
    }
    public function cambiarDirDocumentos(Request $request){

        if($request->has('registrosseleccionados')){
   
            $registros = UsuarioAtendido::whereIn('id',$request->registrosseleccionados)->with(['documentos'])->get();

            
            if($registros->count()>0){
              
                
                foreach ($registros as $registro) {
                  
                    $documentos  = $registro->documentos;
                    
                    if($documentos->count()>0){
                        foreach ($documentos as $documento) {
                            $consentimiento = $documento->documento_nombre_1;
                            $certificado = $documento->documento_nombre_2;
                            $paciente = $registro->nombres;

                            $consentimiento = explode('/',$consentimiento);
                            $certificado = explode('/',$certificado);

                            if(count($consentimiento)==1){

                                
                                //archivos antiguos
                                //cambiar de directorio
                                $new_dir = date('y-m-d',strtotime($registro->fechahora));
                                $newNameFile = $new_dir . '/' . $registro->id . ' - ' . $paciente . ' - CONSENTIMIENTO.pdf';

                                $from_path = 'docs/' . $consentimiento[0];
                                $to_path =  'docs/' . $newNameFile;

                                //cambiar nombre en la base de datos
                                Documento::find($documento->id)->update([
                                    'documento_nombre_1'=> $newNameFile,
                                ]);

                                if(!file_exists('docs/' . $new_dir)){
                                    File::makeDirectory('docs/' . $new_dir . '/');
                                }

                                if(file_exists($from_path)){
                                    File::move($from_path, $to_path);
                                }
                               
                            }
                            /*
                            if(count($certificado)==1){

                                
                                //archivos antiguos
                                //cambiar de directorio
                                $new_dir = date('y-m-d',strtotime($registro->fechahora));
                                $newNameFile2 = $new_dir . '/' . $registro->id . ' - ' . $paciente . ' - CERTIFICADO.pdf';

                                $from_path = 'docs/' . $certificado[0];
                                $to_path =  'docs/' . $newNameFile2;

                                //cambiar nombre en la base de datos
                                Documento::find($documento->id)->update([
                                    'documento_nombre_2'=> $newNameFile2,
                                ]);

                                if(!file_exists('docs/' . $new_dir)){
                                    File::makeDirectory('docs/' . $new_dir . '/');
                                }

                                if(file_exists($from_path)){
                                    File::move($from_path, $to_path);
                                }
                               
                            }*/
                        }
                        
                    }
                }
            }
            
        }
    }
    public function descargarDocumentos(Request $request){

        if($request->has('registrosseleccionados')){
            $zip_file = 'documentos.zip';

            if($request->has('fechaset') && trim($request->fechaset)!=''){

                $zip_file = $request->fechaset . '.zip';
            }

            $zip = new \ZipArchive();

            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            $registros = UsuarioAtendido::whereIn('id',$request->registrosseleccionados)->with(['documentos'])->get();

            $counters = $request->desde;
            $repetidos = [];

            if($registros->count()>0){
              
               
                
                foreach ($registros as $registro) {
                  
                    $documentos  = $registro->documentos;
                    
                    if($documentos->count()>0){
                        foreach ($documentos as $documento) {
                            $consentimiento = $documento->documento_nombre_1;
                            $certificado = $documento->documento_nombre_2;
                            $paciente = $registro->nombres;

                            $path = public_path('docs/'.$consentimiento);
                            $path2 = public_path('docs/'.$certificado);

                            if(file_exists($path)){
                                $real_index = " 1 ";
                                if(array_key_exists($paciente,$repetidos)){
                                    $real_index = " 2 ";
                                }else{
                                    $repetidos[$paciente] = true;
                                }
                                $zip->addFile($path,$paciente .$real_index.' - CONSENTIMIENTO.pdf');
                            }
                            if(file_exists($path2)){
                                //$zip->addFile($path2,$paciente . ' - CERTIFICADO.pdf');
                            }
                      
                        }
                        
                            
                    }else{
                        echo 'sin docs' . '<br>';
                    }
                    $counters++;
                }

                $zip->close();
                return response()->download($zip_file);
            }
            
        }
    }
}
