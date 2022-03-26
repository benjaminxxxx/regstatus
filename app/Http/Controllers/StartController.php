<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Zona;
use App\Models\Marca;
use App\Models\Modulo;
use App\Models\Riesgo;
use App\Models\Valore;
use App\Models\UsuarioAtendido;

class StartController extends Controller
{
    //

    public function index(){

        $registroId = isset($_GET['registro'])?$_GET['registro']:null;
    
        
        
      
        if(Auth::user()->type=='administrador'){
            
            return view('start');
        }
        if(Auth::user()->type=='digitador'){

            //actualizacion miercoles 26/05
            //si digitador debe elegir entre dos paneles, uno para vacunacion y otro para triaje
            if(!session()->has('area_de_trabajo')){
                return $this->getAreaTrabajo();
            }
            if(session()->get('area_de_trabajo')=='admision'){
                return redirect()->route('panel.admision');
            }
            
            if(session()->get('area_de_trabajo')=='vacunatorio'){
                return redirect()->route('panel.vacunatorio');
            }
      
            return $this->usuariosAtendidos($registroId);
        }
        
        if(Auth::user()->type=='enfermero'){
            if(!session()->has('area_de_trabajo')){
                return $this->getAreaTrabajoEnfermero();
            }
            if(session()->get('area_de_trabajo')=='triaje'){
                return redirect()->route('panel.triaje');
            }
            if(session()->get('area_de_trabajo')=='monitoreo'){
                return redirect()->route('panel.monitoreo');
            }
        }
    }
    public function getAreaTrabajo(){

        return view('choose.admisionovacunatorio');

    }
    public function getAreaTrabajoEnfermero(){

        return view('choose.triajeomonitoreo');

    }

    public function vacunaciones(){
        if(Auth::user()->type=='digitador'){
            return view('start');
        }
    }
}
