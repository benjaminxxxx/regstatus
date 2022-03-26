<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\Establecimiento;
use App\Models\Modulo_vacunatorio;
use App\Models\Modulo_admision;
use App\Models\User;
use Auth;

class SeleccionarEstacionTrabajo extends Component
{
    public $seleccionado;
    public $establecimientos;
    public $establecimiento_id;
    public $modulos_admision;
    public $modulos_vacunatorio;
    public $estacion_id;
    public $vacunadores;
    public $codigo_autenticador;
    public $vacunador_id;
    public $textvacunador;
    public $message;
    public $modotolerante = false;
    public $nombre_sede;
    public $filtro = null;
    
    public function mount(){
        
        
        $this->establecimiento_id=Auth::user()->establecimiento_id;

        
        
        $this->textvacunador = 'ELEGIR';

        $current_date = date('Y-m-d');

        User::where([
            ['fecha_ocupacion','<>',$current_date]
        ])->update([
            'ocupado_con'=>null,
            'fecha_ocupacion'=>null,
            'estado_labor'=>'DISPONIBLE',
        ]);

        

        $licenciadoActivo = User::where([
            'ocupado_con'=>Auth::id(),
            'fecha_ocupacion'=>$current_date,
            'estado_labor'=>'OCUPADO'
        ])->first();
        
        if($licenciadoActivo!=null){
            //si es asi, es que ya habia iniciado sesion, simplemente precargar sus datos
            $this->textvacunador = mb_strtoupper($licenciadoActivo->name);
            $this->vacunador_id = $licenciadoActivo->id;
        }
        
    }

    public function render()
    {

        $allFilter = [
            ['establecimiento_id','=',$this->establecimiento_id],
            ['type','=','enfermero']
        ];

        if(trim($this->filtro)==''){
            $this->filtro = null;
        }

        if($this->filtro!=null){
            $allFilter[] = ['name','like','%'.$this->filtro.'%'];

            $this->vacunadores = User::where($allFilter)->orWhere([['dni','like','%'.$this->filtro.'%']])->get();
        }else{
            $this->vacunadores = null;
        }

        return view('livewire.seleccionar-estacion-trabajo');
    }
    public function entrarAdmision(){
        
        session()->put('establecimiento_id',$this->establecimiento_id);
        session()->put('area_de_trabajo',$this->seleccionado);
        session()->put('estacion_id',$this->estacion_id);

        $modulo_admision = Modulo_admision::find($this->estacion_id);
        $modulo_admision_text = '';
        if($modulo_admision!=null){
            $modulo_admision_text = $modulo_admision->nombre_modulo; 
        }

        session()->put('modulo_admision',$modulo_admision_text);

        return redirect()->route('dashboard');
    }
    public function entrarVacunatorio(){
        
        $this->message = '';

        if($this->vacunador_id==null){
            $this->message = 'Falta seleccionar al vacunador';
            return;
        }

        $licenciado = User::where([
            'id'=>$this->vacunador_id,
        ])->first();

        if($licenciado==null){
            $this->message = 'Usuario no existe';
            return;
        }else{
            if (!Hash::check($this->codigo_autenticador, $licenciado->password)) {
                $this->message = 'Error de autenticación';
                return;
            }
        }

        //se debe cambiar el estado del licenciado
        //primero se deben elimiar a estado disponible los licenciados con los que trabaje hoy
        $current_date = date('Y-m-d');

        User::where([
            'ocupado_con'=>Auth::id(),
            ['id','<>',$this->vacunador_id]
        ])->update([
            'ocupado_con'=>null,
            'fecha_ocupacion'=>null,
            'estado_labor'=>'DISPONIBLE',
        ]);
        
        $this->message = null;
        
        //se debe guardar la nueva sesion
        $licenciado->update([
            'ocupado_con'=>Auth::id(),
            'fecha_ocupacion'=>$current_date,
            'estado_labor'=>'OCUPADO',
        ]);
        
        session()->put('establecimiento_id',$this->establecimiento_id);
        session()->put('area_de_trabajo',$this->seleccionado);
        session()->put('estacion_id',$this->estacion_id);
        session()->put('vacunador_id',$this->vacunador_id);
        session()->put('vacunador_nombre',$this->textvacunador);

        $modulo_vacunatorio = Modulo_vacunatorio::find($this->estacion_id);
        $modulo_vacunatorio_text = '';
        if($modulo_vacunatorio!=null){
            $modulo_vacunatorio_text = $modulo_vacunatorio->nombre_vacunatorio; 
        }

        session()->put('modulo_vacunatorio',$modulo_vacunatorio_text);

        return redirect()->route('dashboard');
    }
    public function choose($estacion){
        $this->seleccionado = $estacion;

        $this->establecimientos = Establecimiento::where(['estado'=>'1'])->get();

        if(Auth::user()->establecimiento_id!=null){
            $this->establecimiento_id=Auth::user()->establecimiento_id;
            $haysede = Establecimiento::find(Auth::user()->establecimiento_id);
            if($haysede!=null){
                $this->nombre_sede = $haysede->nombre;
            }else{
                $this->nombre_sede = 'Sede eliminada';
            }
            if($estacion=='vacunatorio'){
                //corrigiendo un bug
                /*
                si se cerro sesion se debe recuperar el nombre del vacunador
                
                */
                $this->getvacunatorio();
            }
            if($estacion=='admision'){
                $this->getadmision();
            }
        }

    }
    public function getvacunatorio(){
        if($this->seleccionado!=null){
            $this->modulos_vacunatorio = Modulo_vacunatorio::where([
                'estado'=>'1',
                'establecimiento_id'=>$this->establecimiento_id
            ])->get();

            
        }
    }
    public function getadmision(){
        if($this->seleccionado!=null){
            $this->modulos_admision = Modulo_admision::where([
                'estado'=>'1',
                'establecimiento_id'=>$this->establecimiento_id
            ])->get();
        }
    }
    public function volver(){
        $this->seleccionado = null;
        $this->establecimiento_id = null;
        $this->modulos_admision = null;
        $this->modulos_vacunatorio = null;
    }
    public function elegirVacunador($vacunador){
        $this->textvacunador = mb_strtoupper($vacunador);
    }
}
