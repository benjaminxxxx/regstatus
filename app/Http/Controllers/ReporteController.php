<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioAtendido;
use App\Exports\UsuarioAtendidoTable;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Riesgo;
use App\Models\Establecimiento;
use Auth;

class ReporteController extends Controller
{
    //
    public function index(Request $request){

        $sedes = null;
        $sede_nombre = null;
        $establecimiento_id = null;

        if(Auth::user()->establecimiento_id==null){
            $sedes = Establecimiento::where(['estado'=>'1'])->get();
        }else{
            $lasede = Establecimiento::where(['id'=>Auth::user()->establecimiento_id,'estado'=>'1'])->first();

            if($lasede!=null){
                
                $establecimiento_id = $lasede->id;
                $sede_nombre = $lasede->nombre;
            }else{
                $establecimiento_id = 'sede eliminada'; //parche para que no cargue ningun dato
                $sede_nombre = 'Sede eliminada';
            }
            
        }

        $registros = null;    
        
        $fechahasta = '';

        //$sedes = Establecimiento::where(['estado'=>'1']);
        $riesgos = Riesgo::where(['estado'=>'1'])->get();
/*
        if($sedes->count()==1){
            //sede unica
            $sede = $sedes->first();
            $establecimiento_id = $sede->id;
        }*/

        $where = ['establecimiento_id'=>$establecimiento_id];   

        if($request->has('send')){
            if($request->send=='export'){
                return $this->exportusuarioatendido($request->all());
            }
            if($request->send=='search'){
                if($request->establecimiento_id!=null){
                    $where['establecimiento_id']=$request->establecimiento_id;
                    $establecimiento_id = $request->establecimiento_id;
                }

                if($request->licenciado!=null){
                    $where['licenciado']=$request->licenciado;
                }

                if($request->estado!=null){
                    $where['estado']=$request->estado;
                }
                if($request->riesgo!=null){
                    $where['grupoderiesgo']=$request->riesgo;
                }
                if($request->dosis!=null){
                    $where['dosis']=$request->dosis;
                }
                
            }
        }
        if($request->fecha!=null){

            if($request->fechahasta!=null){

                $from = date($request->fecha);
                $to = date($request->fechahasta);

                $registros = UsuarioAtendido::whereBetween('fechahora', [$from, $to])->where($where)->orderBy('fechahora','desc')->paginate(25);
            }else{
                $registros = UsuarioAtendido::whereDate('fechahora','=',$request->fecha)->where($where)->orderBy('fechahora','desc')->paginate(25);
            }
            
            
        }else{
            $registros = UsuarioAtendido::where($where)->orderBy('fechahora','desc')->paginate(25);
        }
        
        if($establecimiento_id==null){
            $licenciados = User::where(['type'=>'enfermero'])->get();
        }else{
            $licenciados = User::where(['type'=>'enfermero','establecimiento_id'=>$establecimiento_id])->get();
        }
        

        return view('reporte.registros',[
            'sedes'=>$sedes,
            'riesgos'=>$riesgos,
            'establecimiento_id'=>$establecimiento_id,
            'registros'=>$registros,
            'licenciados'=>$licenciados,
            'licenciado'=>$request->licenciado,
            'fecha'=>$request->fecha,
            'estadol'=>$request->estado,
            'riesgo_request'=>$request->riesgo,
            'dosis_request'=>$request->dosis,
            'fechahasta'=>$request->fechahasta,
            'sede_nombre'=>$sede_nombre,
        ]);

    }

    public function exportusuarioatendido($vars) 
    {
        return Excel::download(new UsuarioAtendidoTable($vars), 'Usuarios Atendidos.xlsx');
    }
}
