<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Riesgo;
use App\Models\UsuarioAtendido;
use App\Models\Archivos_adjunto;
use App\Models\Companion;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Carbon\Carbon;
use File;
use Manny;
use Auth;

class ModuloAdmisionPanel extends Component
{

    use WithFileUploads;
    use WithPagination;

    public $registro_id;
    public $modal_companion_open;
    public $isModalCompanion = false;

    public $companion_tipodocumento;
    public $companion_documento;
    public $companion_nombres;
    public $companion_telefono;
    public $companion_tipo;

    public $tipodocumento;
    public $documento;
    public $nombres;
    public $telefono;
    public $fechanacimiento;
    public $grupoderiesgo;
    public $edad;
    public $dosis;
    public $domicilio;

    public $companions;
    public $fotos;
    public $foto;

    public $dosis_mensaje;
    public $preguntarporeliminar;
    public $pacientePorEliminar;

    public $message_search;
    public $sepuederegistrar = true;

    protected $listeners = ['agregarimagen'];

    public function updated($field)
	{
		if ($field == 'fechanacimiento')
		{
			$this->fechanacimiento = Manny::mask($this->fechanacimiento, "11-11-1111");
		}
	}

    public function render()
    {
        
        $establecimiento_id = session()->get('establecimiento_id');
        $modulo_admision = session()->get('modulo_admision');
     
        $riesgos = Riesgo::orderBy('tiporiesgo')->get();
        $pacientes = UsuarioAtendido::where([
            'estado'=>'ADMISIÓN',
            'establecimiento_id'=>$establecimiento_id,
            'modulo_admision'=>$modulo_admision,
        ])->with(['archivos_adjuntos','companions'])->orderBy('created_at','desc')->paginate(30);
        //$this->confirmingUserDeletion = true;
       

        if(strlen(trim($this->fechanacimiento))>=10){
            //cancular edad
            try {
                $this->edad = Carbon::parse($this->fechanacimiento)->age;
            } catch (\Throwable $th) {
                $this->edad = '';
                $this->fechanacimiento = '';
            }
            
        }
        

        $textbtn = 'CREAR REGISTRO';


        return view('livewire.modulo-admision-panel',[
            'riesgos'=>$riesgos,
            'textbtn'=>$textbtn,
            'pacientes'=>$pacientes,
        ]);
    }
    public function openModalCompanion(){
        $this->isModalCompanion = true;
    }
    public function searchfromdoc(){
        
        $this->message_search = null;

        if(strlen(trim($this->documento))>=8){
            //cancular nombres
            $data = UsuarioAtendido::where(['documento'=>$this->documento])->orderBy('created_at','desc')->first();
            if($data!=null){
                $registro_hoy = null;
                if($data->fechahora==null){
                    //puede que aun no este vacunado, pero si registrado hoy
                    $registro_hoy = date('Y-m-d', strtotime($data->create_at));
                    
                }else{
                
                    $registro_hoy = date( 'Y-m-d', strtotime($data->fechahora) );
                    
                }
                $fecha_hoy = date('Y-m-d');

                if($registro_hoy==$fecha_hoy){
                    $this->sepuederegistrar = false;
                    $this->message_search = 'Se registro hoy';
                    return;
                }else{
                    $this->sepuederegistrar = true;
                }
                $this->tipodocumento = $data->tipodocumento;
                $this->nombres = $data->nombres;
                $this->telefono = $data->telefono;
                $this->fechanacimiento = $data->fecha_nacimiento;
                $this->edad = $data->edad;
                $this->dosis = $data->dosis;
                $this->domicilio = $data->domicilio;
                $this->grupoderiesgo = $data->grupoderiesgo;
                $this->message_search = 'Encontrado en el sistema';

                //actualizacion, si tiene un registro donde esta vacunado, debe actualizarse a dosis a 2
                if($data->estado=='VACUNADO' && $data->dosis=='1'){
                    $this->dosis = '2';
                    $this->dosis_mensaje = ' (1° dosis puesta)';
                }elseif($data->estado=='VACUNADO' && $data->dosis=='2'){
                    $this->dosis = '2';
                    $this->dosis_mensaje = ' (2° dosis puesta)';
                }else{
                    $this->dosis_mensaje = null;
                }
            }else{
                $this->dosis_mensaje = null;
                $this->dosis = '1';
                $this->telefono = null;
                $this->edad = null;
                $this->fechanacimiento = null;
                $this->grupoderiesgo = null;
                $this->domicilio = null;
                if(strlen(trim($this->documento))==8){
                    //BUSCAR EN LA RENIEC
                    $url = 'https://consulta.api-peru.com/api/dni/' . $this->documento;

                    $crl = curl_init();
                    $timeout = 5;
                    curl_setopt($crl, CURLOPT_URL, $url);
                    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
                    $ret = curl_exec($crl);
                    curl_close($crl);
                    $origen = json_decode($ret,true);
                    if(is_array($origen) && count($origen)>0){
                        if($origen['success']==true){
                            $this->nombres = $origen['data']['nombre_completo'];
                            $this->message_search = 'Encontrado en la RENIEC';
                        }else{
                            $this->message_search = 'No encontrado en la RENIEC';
                            $this->nombres = null;
                        }
                    }
                    
                }
            }
        }
    }
    public function store(){

        $establecimiento_id = session()->get('establecimiento_id');
        $modulo_admision = session()->get('modulo_admision');
        $admision_dni = Auth::user()->dni;
        $admision_nombre = Auth::user()->name;
        
        $arrData = [
            'tipodocumento'=>$this->tipodocumento,
            'documento'=>$this->documento,
            'nombres'=>$this->nombres,
            'fecha_nacimiento'=>$this->fechanacimiento,
            'telefono'=>$this->telefono,
            'grupoderiesgo'=>$this->grupoderiesgo,
            'edad'=>$this->edad,
            'horaregistro'=>date('g:i A'),
            'dosis'=>$this->dosis,
            'domicilio'=>$this->domicilio,
            'admision_dni'=>$admision_dni,
            'admision_nombre'=>$admision_nombre,
            'establecimiento_id'=>$establecimiento_id,
            'modulo_admision'=>$modulo_admision,
            'estado'=>'ADMISIÓN',
        ];

        $nuevoPaciente = UsuarioAtendido::create($arrData);

        if($nuevoPaciente){

            request()->session()->flash('flash.banner', 'Paciente registrado');
            request()->session()->flash('flash.bannerStyle', 'success');

            //GUARDAR SI EXISTEN ARCHIVOS
            if(is_array($this->fotos) && count($this->fotos)>0){
                $arr_images = [];
                foreach ($this->fotos as $fotos) {
                    $arr_images[] = [
                        'usuariosatendido_id'=>$nuevoPaciente->id,
                        'nombrearchivo'=>$fotos['imagen'],
                    ];
                }
                Archivos_adjunto::insert($arr_images);
            }
            //GUARDAR SI EXISTEN ACOMPAÑANTES
            if(is_array($this->companions) && count($this->companions)>0){
                $arr_companions = [];
                foreach ($this->companions as $companion) {
                    $arr_companions[] = [
                        'usuariosatendido_id'=>$nuevoPaciente->id,
                        'tipodocumento'=>$companion['tipodocumento'],
                        'documento'=>$companion['documento'],
                        'nombres'=>$companion['nombres'],
                        'telefono'=>$companion['telefono'],
                        'tipo'=>$companion['tipo'],
                    ];
                }
                Companion::insert($arr_companions);
            }

            $this->documento = null;
            $this->nombres = null;
            $this->fechanacimiento = null;
            $this->grupoderiesgo = null;
            $this->edad = null;
            $this->dosis = null;
            $this->domicilio = null;
            $this->telefono = null;
            $this->companions = null;
            $this->fotos = null;
            $this->message_search = null;
        }else{
            request()->session()->flash('flash.banner', 'Error de conexión');
            request()->session()->flash('flash.bannerStyle', 'danger');
        }
    }
    public function storeCompanion(){
        
        if($this->companion_tipodocumento==null){
            $this->companion_tipodocumento = 'dni';
        }
        
        $this->companions[] = [
            'tipodocumento'=>$this->companion_tipodocumento,
            'documento'=>$this->companion_documento,
            'nombres'=>$this->companion_nombres,
            'telefono'=>$this->companion_telefono,
            'tipo'=>$this->companion_tipo,
        ];

        $this->companion_documento = null;
        $this->companion_nombres = null;
        $this->companion_telefono = null;
        $this->companion_tipo = null;

        $this->isModalCompanion = false;
    }
    public function deleteCompanion($index){
        unset($this->companions[$index]);
    }
    public function agregarimagen(){
        
        if($this->foto!=null){
            $name = $this->foto->getClientOriginalName();
            $newName = uniqid().'_'.$name;
            $this->foto->storeAs('',$newName,$disk = 'public');
            $this->fotos[] = [
                'imagen'=>$newName
            ];
        }
    }
    public function eliminarDic($index){

        $image_path = public_path("firmas/" . $this->fotos[$index]['imagen']);

        if(File::exists($image_path)) {
            unset($this->fotos[$index]);
            File::delete($image_path);
        }
    }
    public function PorEliminarPaciente($paciente_id){
        $this->pacientePorEliminar = $paciente_id;
        $this->preguntarporeliminar = true;
    }
    public function eliminarPaciente(){
        //ELIMINAR TODOS SUS DOCUMENTOS ADJUNTOS
        

        $usuarioAtendido = UsuarioAtendido::find($this->pacientePorEliminar);

        if($usuarioAtendido!=null){
            $docs = $usuarioAtendido->archivos_adjuntos();
            $companions = $usuarioAtendido->companions();
            if($docs!=null){
                
                if($docs->count()>0){
                    foreach ($docs as $doc) {
                    
                        $image_path = public_path("firmas/" . $doc->nombrearchivo);

                        if(File::exists($image_path)) {
                            File::delete($image_path);
                        }
                    }
                    $docs->delete();
                }
                
            }
            if($companions!=null){
                if($companions->count()>0){
                    
                    $companions->delete();
                }
            }
        }
        
        $usuarioAtendido->delete();
        $this->preguntarporeliminar = false;
        $this->pacientePorEliminar = null;
    }
    public function elegirriesgo($riesgo){
      
        $this->grupoderiesgo = $riesgo;
    }
    public function eliminarriesgo($id){
        Riesgo::find($id)->delete();
    }
}
