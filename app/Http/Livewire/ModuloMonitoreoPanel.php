<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Establecimiento;
use App\Models\UsuarioAtendido;
use Livewire\WithPagination;
use Auth;
use App\Models\Historial;

class ModuloMonitoreoPanel extends Component
{
    public $modulo;
    public $pordardealta;
    public $mostraralta;

    use WithPagination;

    public function render()
    {
        $where = ['estado'=>'VACUNADO','establecimiento_id'=>Auth::user()->establecimiento_id];
       

        if($this->modulo!=null){
            if(trim($this->modulo)!=''){
                $where[]=['modulo_vacunatorio','like',"%" . $this->modulo . "%"];
            }
        }

        if(Auth::user()->establecimiento_id==null){
            return view('error',['message'=>'No tiene una sede prestablecida']);
        }
        $establecimiento = Establecimiento::find(Auth::user()->establecimiento_id);

        if($establecimiento==null){
            return view('error',['message'=>'La Sede a la que está vinculado(a) ya no existe']);
        }

        $tiempo = (int)$establecimiento->tiempoespera;

        $registros = UsuarioAtendido::where($where)->orderBy('fechahora','desc')->paginate(20);

        $misregistros = UsuarioAtendido::where(['lector_dni'=>Auth::user()->dni])->orderBy('updated_at','desc')->paginate(20);

        return view('livewire.modulo-monitoreo-panel',[
            'tiempo'=>$tiempo,
            'registros'=>$registros,
            'misregistros'=>$misregistros,
        ]);
    }
    public function preguntaralta($pordardealta){
        $this->pordardealta = $pordardealta;
        $this->mostraralta = true;
    }
    public function alta($id){

        $registro = UsuarioAtendido::find($id);
        $datos = '';

        if($registro!=null){
            $datos = $registro->dni . ': ' . $registro->nombres;
        };

        $horaalta = date('g:i A');

        $registro->update([
            'estado'=>'ALTA',
            'lector_dni'=>Auth::user()->dni,
            'lector'=>Auth::user()->name,
            'horaalta'=>$horaalta
        ]);

        $this->mostraralta = null;
        $this->pordardealta = null;

        Historial::create([
            'evento'=>'Alta de registro',
            'responsable'=>Auth::user()->name,
            'registro'=>$datos
        ]);
        
    }
}
