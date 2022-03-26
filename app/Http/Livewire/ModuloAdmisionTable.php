<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Rede;
use App\Models\Modulo_admision;
use App\Models\Establecimiento;
use Livewire\WithPagination;
use Auth;

class ModuloAdmisionTable extends Component
{
    use WithPagination;

    public $message;
    public $rede_id;
    public $establecimientos;
    public $establecimiento_id;
    public $nombre_modulo;
    public $modulo_admision_id;

    public function mount(){
        //redgerencia
        //$this->redgerencia = Rede::all();
    }

    public function render()
    {
        $sedes = null;
        $sede_nombre = null;

        if(Auth::user()->establecimiento_id==null){
            $sedes = Establecimiento::where(['estado'=>'1'])->get();
        }else{
            $lasede = Establecimiento::where(['id'=>Auth::user()->establecimiento_id,'estado'=>'1'])->first();

            if($lasede!=null){
                
                $this->establecimiento_id = $lasede->id;
                $sede_nombre = $lasede->nombre;
            }else{
                $this->establecimiento_id = 'sede eliminada'; //parche para que no cargue ningun dato
                $sede_nombre = 'Sede eliminada';
            }
            
        }

        $where = [];
        if($this->establecimiento_id!=null){
            $where['establecimiento_id'] = $this->establecimiento_id;
        }
        $modulosAdmision = Modulo_admision::with('establecimiento')->where($where)->paginate(); 
       
       
        //dd($modulosAdmision);

        return view('livewire.modulo-admision-table',[
            'modulos'=>$modulosAdmision,
            'sedes'=>$sedes,
            'sede_nombre'=>$sede_nombre,
        ]);
    }
    public function getestablecimientos(){
        $vrede_id = $this->rede_id;
       
        $this->establecimientos = Establecimiento::where(['rede_id'=>$vrede_id,'estado'=>'1'])->get();
    }
    public function store(){
        $moduloAdmision = Modulo_admision::updateOrCreate([
            'id'=>$this->modulo_admision_id,
        ],[
            'establecimiento_id'=>$this->establecimiento_id,
            'nombre_modulo'=>mb_strtoupper($this->nombre_modulo)
        ]);  
    }
    public function eliminar_modulo($id){
        Modulo_admision::find($id)->delete();
    }
    public function active($id,$estado){
        Modulo_admision::find($id)->update([
            'estado'=>$estado
        ]);
    }
}
