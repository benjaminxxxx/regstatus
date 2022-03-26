<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Licenciados;
use App\Models\Marca;
use App\Models\Modulo;
use App\Models\Riesgo;
use App\Models\Valore;
use App\Models\Historial;
use App\Models\UsuarioAtendido;
use Auth;

class Vacunacion extends Component
{

    public $textbtn;
    public $registro_id;
    public $message_error;
    public $message_success;

    public $registros;
    public $total_registros;
    //fields
    public $dni;
    public $field_nombre;
    public $field_apellido_paterno;
    public $field_apellido_materno;
    public $field_edad;
    public $field_telefono;
    public $field_grupoderiesgo;
    public $field_consentimiento;
    public $field_apto;
    public $field_observacion;

    public $licenciado;
    public $marca;
    public $lote;

    protected $listeners = ['search'];

    public function mount(){
        $this->textbtn = 'CREAR REGISTRO';
    }

    public function render()
    {

        $licenciados = Licenciados::all();
        $marcas = Marca::all();
/*
        $old = new \stdClass;
        $old->day = '01';
        $old->month = '01';
        $old->year = '';
        $old->marca = '';*/
        $modulo = Modulo::find(session()->get('modulo'))->modulo;
        
        $registros_table = UsuarioAtendido::where(['estado'=>'2','modulo'=>$modulo])->orderBy('fechahora','desc')->paginate(10);
        
        $tiempo = Valore::find(1)->valor;

     
        return view('livewire.vacunacion',[
            'licenciados'=>$licenciados,
            'marcas'=>$marcas,
            'registros_table'=>$registros_table,
            'tiempo'=>$tiempo,
            //'old'=>$old,
        ]);
    }
    public function search(){
        //opcion 2: hay mas de un registro, hay que dar a elegir
        $max = strlen($this->dni);
        $this->total_registros = null;

        if($max==8){
            $registros = UsuarioAtendido::where(['dni'=>$this->dni,['estado','<>','1']])->orderBy('created_at','desc')->get();

            $this->total_registros = $registros->count();

            if($registros->count()==0){
                
                $this->message_error = 'No se han encontrado ningún registro';
                
            }else{
                $this->registros = $registros;
            }

            if($registros->count()==1){
                foreach ($registros as $registro) {
                    # code...
                    $registroid = $registro->id;
                    $this->choose($registroid);
                }
                
            }
        }        
    }
    public function seleccionar($id){
        $this->choose($id);
        $this->registros = null;
    }
    public function choose($id){
        $data = UsuarioAtendido::find($id);
        $this->registro_id = $data->id;
        $this->field_nombre = $data->nombre;
        $this->field_apellido_paterno = $data->apellido_paterno;
        $this->field_apellido_materno = $data->apellido_materno;
        $this->field_edad = $data->edad;
        $this->field_telefono = $data->telefono;
        $this->field_grupoderiesgo = $data->grupoderiesgo;
        $this->field_consentimiento = $data->consentimiento;
        $this->field_apto = $data->apto;
        $this->field_observacion = $data->observacion;

        $this->licenciado = $data->licenciado;
        $this->marca = $data->marca;
        $this->lote = $data->lote;
    }
    
    public function store(){

        $registro = [
            'licenciado'=>$this->licenciado,
            'marca'=>$this->marca,
            'lote'=>$this->lote
        ];

        //registramos al usuario activo que registro los datos
        $registro['digitador'] = mb_strtoupper(Auth::user()->name);
        $registro['digitador_dni'] = mb_strtoupper(Auth::user()->dni);

        $registro['estado'] = '2';

        $modulo = Modulo::find(session()->get('modulo'))->modulo;
        $registro['modulo'] = $modulo;
        
        //parseamos a lineamientos estandares la fechahora
        //$fechahora = date("Y-m-d H:i:00", strtotime($request->fechahora));
        $fechahora = date("Y-m-d H:i:00");
        $registro['fechahora'] = $fechahora;
        
        $response = [];

        if($this->registro_id!=null){
            //actualizar registro
            $registrado = UsuarioAtendido::where(['id'=>$this->registro_id])->update($registro);
            $this->message_success = 'Registro actualizado con exito';
            $this->resete();
        }
    }
    public function editar($id){
        $this->choose($id);
    }

    public function eliminar($id){
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
    public function eliminar_error(){
        $this->message_error = null;
    }
    public function eliminar_success(){
        $this->message_success = null;
    }
    public function devolver($id){
        
        $regdev = UsuarioAtendido::find($id);
        $datos = '';

        if($regdev!=null){
            $datos = $regdev->dni . ': ' . $regdev->apellido_paterno . ' ' .$regdev->apellido_materno . ', ' . $regdev->nombre;
        };

        $regdev->licenciado = null;
        $regdev->marca = null;
        $regdev->lote = null;
        $regdev->modulo = null;
        $regdev->estado = '0';
        $regdev->save();

        Historial::create([
            'evento'=>'Devolución de registro',
            'responsable'=>Auth::user()->name,
            'registro'=>$datos
        ]);
    }
    public function cancelar(){
        $this->resete();
    }
    public function resete(){
        $this->registro_id = null;
        $this->field_nombre = null;
        $this->field_apellido_paterno = null;
        $this->field_apellido_materno = null;
        $this->field_edad = null;
        $this->field_telefono = null;
        $this->field_grupoderiesgo = null;
        $this->field_consentimiento = null;
        $this->field_apto = null;
        $this->field_observacion = null;

        $this->licenciado = null;
        $this->marca = null;
        $this->lote = null;
    }
}
