<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsuarioAtendido;
use App\Models\Modulo;
use App\Models\Historial;
use App\Models\Zona;
use Carbon\Carbon;
use App\Models\Riesgo;
use App\Models\Valore;
use Auth;

class RegistroController extends Controller
{
    //
    public function get(Request $request){

        $registros = UsuarioAtendido::orderBy('fechahora','desc')->paginate(10);

        $tiempo = Valore::find(1)->valor;

        return view('snippets.registros',[
            'tiempo'=>$tiempo,
            'registros'=>$registros,
        ]);

    }
    public function triaje(Request $request){

        $zona = Zona::find(session()->get('zona'))->zona;

        $registros = UsuarioAtendido::where(['estado'=>'0','zona'=>$zona])->orderBy('fechahora','desc')->paginate(10);

        return view('snippets.triaje',[
            'registros'=>$registros,
        ]);

    }

    public function delete($id){

        $registro = UsuarioAtendido::find($id);
        $datos = '';

        if($registro!=null){
            $datos = $registro->dni . ': ' . $registro->apellido_paterno . ' ' .$registro->apellido_materno . ', ' . $registro->nombre;
        };

        UsuarioAtendido::find($id)->delete();

        Historial::create([
            'evento'=>'Eliminación de registro',
            'responsable'=>Auth::user()->name,
            'registro'=>$datos
        ]);

    }
    
    public function store(Request $request){
        
        $registro = $request->only(['dni','consentimiento','dosis','grupoderiesgo','telefono','observacion','apto']);
        

        $registro['nombre'] = mb_strtoupper($request->nombre);
        $registro['apellido_paterno'] = mb_strtoupper($request->apellido_paterno);
        $registro['apellido_materno'] = mb_strtoupper($request->apellido_materno);

        //obtenemos la fecha y calculaomos la edad
        $fecha = $request->year . '-' . $request->month . '-' . $request->day;
        $edad = Carbon::parse($fecha)->age;

        $registro['fecha_nacimiento'] = $fecha;
        $registro['edad'] = $edad;

        //registramos al usuario activo que registro los datos
        $registro['triaje'] = mb_strtoupper(Auth::user()->name);
        $registro['triaje_dni'] = mb_strtoupper(Auth::user()->dni);


        $registro['estado'] = '0';

        $getzona = Zona::find(session()->get('zona'))->zona;
        $registro['zona'] = $getzona;

        //buscar grupo de riesgo, y si no existe, debemos guardarlo
        $riesgos = Riesgo::where(['riesgo'=>$request->grupoderiesgo])->first();
        if($riesgos==null){
            //guardarlos
            /*Riesgo::create([
                'riesgo'=> mb_strtoupper($request->grupoderiesgo)
            ]);*/
        }
        
        //parseamos a lineamientos estandares la fechahora
        $fechahora = date("Y-m-d H:i:00", strtotime($request->fechahora));

      
        if($request->registro_id==''){
            //guardar registro
            $registrado = UsuarioAtendido::create($registro);
        }else{
            //actualizar registro
            $registrado = UsuarioAtendido::where(['id'=>$request->registro_id])->update($registro);
        }
        

        if($registrado){

            return redirect()->route('dashboard');
        }
        

    }
    
    public function getmodulos(Request $request){

        $zonaName = $request->id;
        $zona_data = Zona::where(['zona'=>$zonaName])->first();
        $zona_id = null;
        
        if($zona_data!=null){
            $zona_id = $zona_data->id;
        }

        $modulo = Modulo::where(['zona_id'=>$zona_id])->get()->toArray();
        return json_encode($modulo);
    }
    
}
