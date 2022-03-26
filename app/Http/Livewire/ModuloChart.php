<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UsuarioAtendido;
use App\Models\User;
use App\Models\Riesgo;
use App\Models\Establecimiento;
use Auth;

use App\Exports\UsuarioAtendidoTable;
use Maatwebsite\Excel\Facades\Excel;

class ModuloChart extends Component
{
    public $modulo;
    public $licenciado;
    public $fechahora;
    public $establecimiento_id;

    public $vacunasPorEdades;
    public $vacunasPorRiesgos;
    public $total_dosis;
    public $total_dosis_1;
    public $total_dosis_2;

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

        

        if($this->establecimiento_id==null){
            $licenciados = User::where(['type'=>'enfermero'])->get();
        }else{
            $licenciados = User::where(['type'=>'enfermero','establecimiento_id'=>$this->establecimiento_id])->get();
        }
        
        $where = ['estado'=>'VACUNADO'];

        if($this->establecimiento_id!=null && $this->establecimiento_id!=''){
            $where['establecimiento_id']=$this->establecimiento_id;
        }
        
        if (Auth::user()->type=='digitador') {
            $digitador_dni = Auth::user()->dni;
            $where['digitador_dni']=$digitador_dni;
        }
        

        if($this->modulo!=null){
            if(trim($this->modulo)!=''){
                $where[]=['modulo_vacunatorio','like',"%" . $this->modulo . "%"];
            }
        }
        if($this->licenciado!=null){
            if(trim($this->licenciado)!=''){
                $where[]=['licenciado','like',"%" . $this->licenciado . "%"];
            }
        }

        $this->total_dosis = 0;
        $this->total_dosis_1 = 0;
        $this->total_dosis_2 = 0;

        /*******************************Este parche es para limitar a un dia para que no colapse el servidor */
        if($this->fechahora==null || trim($this->fechahora)==''){
            $this->fechahora = date('Y-m-d');
        }
        /**************************************************************************************************** */
        
        if($this->fechahora!=null && trim($this->fechahora)!=''){
            
            $usuariosAtendidos = UsuarioAtendido::whereDate('fechahora','=',$this->fechahora)->where($where)->limit(5000)->get();
        }else{
            
            $usuariosAtendidos = UsuarioAtendido::where($where)->limit(5000)->get();
            //dd($usuariosAtendidos->count());
        }
        if($_SERVER['REMOTE_ADDR']=='190.113.215.189'){
           // dd($sede_nombre);
        }
        $buscarPorEdades = Riesgo::where(['tiporiesgo'=>1])->get()->toArray();

        $buscarPorRiesgos = Riesgo::where(['tiporiesgo'=>2])->get()->toArray();;

        $this->vacunasPorEdades = [];
        $this->vacunasPorRiesgos = [];

        if(is_array($buscarPorEdades) && count($buscarPorEdades)>0){
            foreach ($buscarPorEdades as $sindex => $bpe) {
                $this->vacunasPorEdades[$sindex] = $bpe;
                $this->vacunasPorEdades[$sindex]['dosis_1'] = 0;
                $this->vacunasPorEdades[$sindex]['dosis_2'] = 0;
            }
        }
        
        foreach ($buscarPorRiesgos as $rindex => $bpr) {
            $this->vacunasPorRiesgos[$rindex] = $bpr;
            $this->vacunasPorRiesgos[$rindex]['dosis_1'] = 0;
            $this->vacunasPorRiesgos[$rindex]['dosis_2'] = 0;
        }

        
        if($usuariosAtendidos->count()>0){
            foreach ($usuariosAtendidos as $usuarioAtendido) {

                $grupo = mb_strtoupper($usuarioAtendido->grupoderiesgo);
                if(trim($grupo)){
                    foreach ($buscarPorEdades as $index => $between) {
                        $edad = (int)$usuarioAtendido->edad;
                        //if($edad<=$between['max'] && $edad>=$between['min']){
                            if(mb_strtoupper($between['riesgo'])==$grupo){

                            $dosis = (int)$usuarioAtendido->dosis;


                            if($dosis==1){
                                
                                $this->vacunasPorEdades[$index]['dosis_1']+=1;
                                $this->total_dosis_1++;
                            }
                            if($dosis==2){
                            
                                $this->vacunasPorEdades[$index]['dosis_2']+=1;
                                $this->total_dosis_2++;
                            }
                        }
                    }
                }
                
                if(trim($grupo)){
                    $encontrado = false;
                    foreach ($buscarPorRiesgos as $indexriesgo => $in) {
                    
                        if(mb_strtoupper($in['riesgo'])==$grupo){
    
                            $dosis = (int)$usuarioAtendido->dosis;
                            if($dosis==1){
                                $encontrado = true;
                                $this->vacunasPorRiesgos[$indexriesgo]['dosis_1']+=1;
                                $this->total_dosis_1++;
                            }
                            if($dosis==2){
                                $encontrado = true;
                                $this->vacunasPorRiesgos[$indexriesgo]['dosis_2']+=1;
                                $this->total_dosis_2++;
                            }
                            
                        }
                    }
                    /*
                    DOSIS OTROS
                    if($encontrado == false){
                        
                        $dosis = (int)$usuarioAtendido->dosis;
                        if($dosis==1){
                            $encontrado = true;
                            $vacunasPorRiesgos[7]['dosis_1']+=1;
                        }
                        if($dosis==2){
                            $encontrado = true;
                            $vacunasPorRiesgos[7]['dosis_2']+=1;
                        }
                    }*/

                }
                
            }
        }

        
        $this->total_dosis = $this->total_dosis_1 + $this->total_dosis_2;
        
        return view('livewire.modulo-chart',[
            'licenciados'=>$licenciados,
            'sedes'=>$sedes,
            'sede_nombre'=>$sede_nombre,
        ]);

        
    }

    public function filtrar(){

        
    }

    public function exportar(){
        
        $arr = [
            'fecha'=>$this->fechahora,
            'digitador_dni'=>Auth::user()->dni,
            'digitador_name'=>Auth::user()->name,
            'vacunador_id'=>session()->get('vacunador_id'),
            'vacunador_nombre'=>session()->get('vacunador_nombre'),
        ];
        return $this->exportusuarioatendido($arr);
    }

    public function exportusuarioatendido($vars) 
    {
        return Excel::download(new UsuarioAtendidoTable($vars), 'USUARIOS ATENDIDOS POR '.Auth::user()->name.'.xlsx');
    }
}
