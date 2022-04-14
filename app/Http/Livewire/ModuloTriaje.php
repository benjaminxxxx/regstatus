<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UsuarioAtendido;
use App\Models\Establecimiento;
use App\Models\Riesgo;
use App\Models\Marca;
use App\Models\Documento;
use PDF;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuloTriaje extends Component
{
    public $registro_id;
    public $message_search;

    public $tipodocumento;
    public $documento;
    public $nombres;
    public $telefono;
    public $fechanacimiento;
    public $grupoderiesgo;
    public $edad;
    public $dosis;
    public $marca;
    public $domicilio;

    public $companion_tipodocumento;
    public $companion_documento;
    public $companion_telefono;
    public $companion_nombres;
    public $companion_tipo;

    public $askDoc = false;
    public $askadvertencia = false;
    public $mostrarconsentimiento = false;
    public $mostrarconsentimiento14a = false;
    public $mostrarconsentimiento14b = false;
    public $mostrarconsentimientoSino = false;
    public $mostrarconsentimientoChild = false;

    public $mostrarconsentimientoTercera = false;
    public $mostrarconsentimiento1ra2da18mas = false;

    public $mostrarconsentimiento511 = false;
    public $mostrarconsentimiento1217 = false;
    
    //update 29/10/21
    public $mostrarconsentimientoMenor = false;
    public $estado_edad;
    public $child_documento2_pre1='NO';
    public $child_documento2_pre2='NO';
    public $child_documento2_pre3='SI';


    //DATOS DE DOCUMENTACIONES
    public $documento1_redgerencia;
    public $documento1_establecimiento;
    public $documento2;
    public $documento3;

    public $documento1_pre1='NO';
    public $documento1_pre2='NO';
    public $documento1_pre3='NO';

    public $documento2_pre1='NO';
    public $documento2_pre2='NO';
    public $documento2_pre3='SI';

    public $sin_documento2_pre1='SI';
    public $sin_documento2_pre2='NO';
    public $sin_documento2_pre3='NO';

    public $sin_documento3_pre1 = 'NO';
    public $sin_documento3_pre2 = 'NO';
    public $sin_documento3_pre3 = 'NO';

    public $documento3_pre1 = 'NO';
    public $documento3_pre2 = 'NO';
    public $documento3_pre3 = 'NO';
    public $documento3_pre4 = 'NO';
    public $documento3_pre5 = 'NO';
    public $documento3_pre6 = 'NO';
    public $documento3_pre7 = 'NO';
    public $documento3_pre8 = 'NO';
    public $documento3_pre9 = 'NO';

    public $documento4_pre1 = 'NO';
    public $documento4_pre2 = 'NO';
    public $documento4_pre3 = 'NO';
    public $documento4_pre4 = 'NO';
    public $documento4_pre5 = 'NO';
    public $documento4_pre6 = 'NO';
    public $documento4_pre7 = 'NO';

    public $firmaConsentimiento1;
    public $firmaConsentimiento2;
    public $firmaDesistimiento;

    public $documento_nombre_1;
    public $documento_nombre_2;
    public $documento_nombre_3;

    public $documentos;
    public $documentos_totales;
    public $firmartraije='consentimiento';
    public $establecimiento_id;

    public $tutor;

    //actualizacion
    public $archivosAdjuntos;

    public $setdocumento;

    public $poderGenerarConsentimiento = false;

    public $opt_consentimiento;

    protected $listeners = [
        'guardarFirma',
        'guardarFirma2',
        'guardarFirmanv',
        'guardarFirma4',
        'guardarFirmaChild',
        'guardarFirmaTercera',
        'guardarFirma1ra2da18mas',
        'guardarFirma511',
        'guardarFirmaCodex'
    ];

    public function mount(){
        $red = Establecimiento::with(['rede'])->where(['estado'=>'1'])->first();
        if($red!=null){
            $this->documento1_redgerencia = $red->rede->redgerencia;
            $this->documento1_establecimiento = $red->nombre;
        }
        if(Auth::user()->establecimiento_id!=null){
            $red_user = Establecimiento::with(['rede'])->where(['estado'=>'1','id'=>Auth::user()->establecimiento_id])->first();
            if($red_user!=null){
                $this->documento1_redgerencia = $red_user->rede->redgerencia;
                $this->documento1_establecimiento = $red_user->nombre;
                $this->establecimiento_id = $red_user->id;
            }
        }
    }
    
    public function render()
    {
       
        $usuariosTriaje = UsuarioAtendido::where(['estado'=>'ADMISIÓN','establecimiento_id'=>$this->establecimiento_id])->orderBy('updated_at','desc')->paginate(10);

        //dd(session()->all());

        if($this->setdocumento!=null){
            //ACTUALIZACION, DEBEN JALAR LOS DOCUMENTOS DE LAS VACACIONES ANTERIORES
            $user_old_data = UsuarioAtendido::where(['documento'=>$this->setdocumento])->with([
                'documentos'
            ])->get()->toArray();

            if(is_array($user_old_data) && count($user_old_data)>0){
                //si hay varios registros del mismo usuario, debemos extraer la dosis y conectarlos con los documentos
                $arr_total_documentos = [];
                foreach ($user_old_data as $old_user) {
                    $dosis = $old_user['dosis'];
                    $documento_user_old = $old_user['documentos'];
                    $arr_total_documentos[] = [
                        'dosis'=>$dosis,
                        'documentos'=>$documento_user_old,
                    ];
                }
                $this->documentos_totales = $arr_total_documentos;
            }else{
                $this->documentos_totales = null;
            }
        }

        $riesgos = Riesgo::orderBy('tiporiesgo')->get();
        $marcas = Marca::all();

        if ($this->marca!=null && trim($this->marca)!='') {
            $this->poderGenerarConsentimiento = true;
            
        }else{
            $this->poderGenerarConsentimiento = false;
        }
        
        return view('livewire.modulo-triaje',[
            'riesgos'=>$riesgos,
            'documentos'=>$this->documentos,
            'usuariosTriaje'=>$usuariosTriaje,
            'marcas'=>$marcas
        ]);
    }
    public function eliminardocumentos($docs_id){
        
        $all_docs = Documento::find($docs_id);


        if($all_docs!=null){
            $image_path1 = public_path("docs/" . $all_docs->documento_nombre_1);
            $image_path2 = public_path("docs/" . $all_docs->documento_nombre_2);
            //$image_path3 = public_path("docs/" . $all_docs->documento_nombre_3);

            if(File::exists($image_path1)) {
                File::delete($image_path1);
            }
            
            if(File::exists($image_path2)) {
                File::delete($image_path2);
            }
            /*
            if(File::exists($image_path3)) {
                File::delete($image_path3);
            }*/
            $all_docs->delete();
            
        }
        $this->render();
        //$this->documentos = Documento::where(['usuariosatendido_id'=>$this->registro_id])->get();
    }
    public function store(){

        //buscar grupo de riesgo, y si no existe, debemos guardarlo
        $riesgos = Riesgo::where(['riesgo'=>$this->grupoderiesgo])->first();
        if($riesgos==null){
            //guardarlos
            /*Riesgo::create([
                'riesgo'=> mb_strtoupper($this->grupoderiesgo)
            ]);*/
        }
        
        $arrData = [
            'tipodocumento'=>$this->tipodocumento,
            'documento'=>$this->documento,
            'nombres'=>$this->nombres,
            'fecha_nacimiento'=>$this->fechanacimiento,
            'telefono'=>$this->telefono,
            'grupoderiesgo'=>$this->grupoderiesgo,
            'edad'=>$this->edad,
            'dosis'=>$this->dosis,
            'marca'=>$this->marca,
            'domicilio'=>$this->domicilio
        ];

        if($this->domicilio!=null && trim($this->domicilio)!=''){

            if ($this->marca!=null && trim($this->marca)!='') {
                $this->poderGenerarConsentimiento = true;
                
            }else{
                $this->poderGenerarConsentimiento = false;
            }
            
        }else{
            $this->poderGenerarConsentimiento = false;
        }

        

        try {
            $regUpdate = UsuarioAtendido::find($this->registro_id)->update($arrData);
            request()->session()->flash('flash.banner', 'Se actualizó el registro');
            request()->session()->flash('flash.bannerStyle', 'success');
        } catch (\Throwable $th) {
            request()->session()->flash('flash.banner', 'Error:' . $th->getMessage());
            request()->session()->flash('flash.bannerStyle', 'danger');
        }

    }
    function export($fileoriginal,$filename,$tipo= 'CONSENTIMIENTO'){
        try {
            //$dir_file = date('Y-m-d') . '/';
            $path = public_path('docs/'.$fileoriginal);
        
            return response()->download($path, $filename . ' - '.$tipo.'.pdf');
        } catch (\Throwable $th) {
            dd('El archivo no existe');
        }
        
    }
    function autoseleccionar($documento,$id){
        $this->documento = $documento;
        $this->buscarDeAdmision($id);
    }
    public function updateList(){
        $this->render();
    }
    public function buscarDeAdmision($id=null){

        $arrWhere = [
            'documento'=>$this->documento,
        ];

        if($id!=null){
            $arrWhere['id'] = $id;
        }
        
        $usuario = UsuarioAtendido::with([
            'archivos_adjuntos',
            'companions',
            'documentos'
        ])->where($arrWhere)->whereIn('estado', ['ADMISIÓN', 'TRIAJE']);

        $this->nombres = null;
            $this->fechanacimiento = null;
            $this->grupoderiesgo = null;
            $this->edad = null;
            $this->dosis = null;
            $this->domicilio = null;
            $this->telefono = null;
            $this->registro_id = null;
            $this->archivosAdjuntos = null;

        if($usuario->count()==0){
            
            

            request()->session()->flash('flash.banner', 'No se encontro al paciente');
            request()->session()->flash('flash.bannerStyle', 'danger');
            return;
        }

        request()->session()->flash('flash.banner', 'Se encontró al paciente');
        request()->session()->flash('flash.bannerStyle', 'success');
        
        if($usuario->count()>=1){
            
            $usuario = $usuario->first();
            $this->registro_id = $usuario->id;
            $this->nombres = $usuario->nombres;
            $this->tipodocumento = $usuario->tipodocumento;
            $this->fechanacimiento = $usuario->fecha_nacimiento;
            $this->telefono = $usuario->telefono;
            $this->grupoderiesgo = $usuario->grupoderiesgo;
            $this->edad = $usuario->edad;
            $this->dosis = $usuario->dosis;
            $this->domicilio = $usuario->domicilio;

            if($usuario->archivos_adjuntos->count()>0){
                $this->archivosAdjuntos = $usuario->archivos_adjuntos;
            }

            if($this->edad<18){
                //actualizacion, si el usuario es menor a 18, debe de autoseleccionarse el chebox
                //pero debe tener la remota posibilidad de deshabilitarlo por el tema de los documentos

                $this->estado_edad = true;
            }else{
                $this->estado_edad = false;
            }

           
            if($usuario->domicilio!=null && trim($usuario->domicilio)!=''){
                if ($this->marca!=null && trim($this->marca)!='') {
                    $this->poderGenerarConsentimiento = true;
                    
                }else{
                    $this->poderGenerarConsentimiento = false;
                }
            }else{
                $this->poderGenerarConsentimiento = false;
            }

            $this->calcularConsentimiento();

            $this->documentos = $usuario->documentos;

            $this->setdocumento = $usuario->documento;

            if($usuario->companions->count()>=1){
                $companion = $usuario->companions->first();
              
                $this->companion_tipodocumento=$companion->tipodocumento;
                $this->companion_documento=$companion->documento;
                $this->companion_telefono=$companion->telefono;
                $this->companion_nombres=$companion->nombres;
                $this->companion_tipo=$companion->tipo;
            }
            
        }
        
    }
    public function calcularConsentimiento(){
        if($this->edad>=18 && $this->dosis==3){
            $this->opt_consentimiento = '3ra18mas';
        }elseif($this->edad>=18 && ($this->dosis==1 || $this->dosis==2)){
            $this->opt_consentimiento = '1ra2da18mas';
        }elseif($this->edad>=5 && $this->dosis<=11){
            $this->opt_consentimiento = '511';
        }else{
            $this->opt_consentimiento = null;
        }
    }
    public function mostrarElConsentimiento(){

        $this->askDoc = false;

        if(Auth::user()->firma==null){
           

            request()->session()->flash('flash.banner', 'Su firma ha sido eliminada');
            request()->session()->flash('flash.bannerStyle', 'danger');
            return;
        }
        
        $this->mostrarconsentimiento14a = false;

        //actualizar la marca de la vacuna del paciente
        $arrData = [
            'dosis'=>$this->dosis,
            'marca'=>$this->marca,
        ];


        try {

            


            $regUpdate = UsuarioAtendido::find($this->registro_id)->update($arrData);

            //parche 2022, ahora hay un combo par preseleccionar de forma automatica el numero de firma
            if($this->opt_consentimiento!=null){
                switch ($this->opt_consentimiento) {
                    case '3ra18mas':
                        $this->emit('generar-firma-tres','1');
                        $this->mostrarconsentimientoTercera = true;
                        break;
                    case '1ra2da18mas':
                        $this->emit('generar-firma-1ra2da18mas','1');
                        $this->mostrarconsentimiento1ra2da18mas = true;
                        break;
                    case '511':
                      
                        $this->emit('generar-firma-511','1');
                        $this->mostrarconsentimiento511 = true;
                        break;
                    case '1217':
                    
                        $this->emit('generar-firma-1217','1');
                        $this->mostrarconsentimiento1217 = true;
                        break;
                    
                    default:
                        $this->mostrarconsentimiento = true;
                        break;
                }
            }else{
                //version antigua continua
                if($this->estado_edad==true){
                    //parche de actualizacion para los niños
                    $this->emit('generar-firma-child','1');
                    $this->mostrarconsentimientoChild = true;
                }else{
                    //parche, actualizacion para la tercera dosis
                  
                    if($this->dosis=="3" || $this->dosis==3){
                        //generar tercer consentimiento
                        $this->emit('generar-firma-tres','1');
                        $this->mostrarconsentimientoTercera = true;
                    }else{
                        if($this->marca=='SINOPHARM'){
                            $this->emit('generar-firma-sin','1');
                            $this->mostrarconsentimientoSino = true;
                        }else{
                            $this->mostrarconsentimiento = true;
                        }
                    }
                    
                }
            }

            

        } catch (\Throwable $th) {
            request()->session()->flash('flash.banner', 'Error:' . $th->getMessage());
            request()->session()->flash('flash.bannerStyle', 'danger');
        }

        
    }
    public function mostrarElConsentimiento14a(){
        
        $this->mostrarconsentimiento = false;
        $this->mostrarconsentimiento14b = false;
        $this->mostrarconsentimiento14a = true;
        //$this->emit('generar-firma');
        if($this->firmartraije==null || $this->firmartraije=='consentimiento'){
            $this->emit('generar-firma','1');
        }else{
            $this->emit('generar-firma','2');
        }
        
    }
    public function mostrarElConsentimiento14b(){
        
        $this->mostrarconsentimiento = false;
        $this->mostrarconsentimiento14a = false;
        $this->mostrarconsentimiento14b = true;
        $this->emit('generar-firma-final');
    }

    public function guardarFirma($imagenConsentimiento,$imagenDesistimiento){

        $this->firmaConsentimiento1 = $this->documento.uniqid() .".png";
        $this->firmaDesistimiento = $this->documento.uniqid().".png";

        $path1 = "firmas/".$this->firmaConsentimiento1;
        $path2 = "firmas/".$this->firmaDesistimiento;

        $status1 = file_put_contents($path1,base64_decode($imagenConsentimiento));
        $status2 = file_put_contents($path2,base64_decode($imagenDesistimiento));
        
        $this->mostrarElConsentimiento14b();
    }

    public function guardarFirma4($imagenConsentimiento,$imagenDesistimiento){

        $this->firmaConsentimiento1 = $this->documento.uniqid() ."_sin.png";
        $this->firmaDesistimiento = $this->documento.uniqid()."_sin.png";

        $path1 = "firmas/".$this->firmaConsentimiento1;
        $path2 = "firmas/".$this->firmaDesistimiento;

        $status1 = file_put_contents($path1,base64_decode($imagenConsentimiento));
        $status2 = file_put_contents($path2,base64_decode($imagenDesistimiento));

        $this->mostrarconsentimientoSino = false;
        //$this->emit('habilitar-boton');
        
        return $this->generarDocumentosSin();
    }
    public function guardarFirmaChild($imagenConsentimiento,$imagenDesistimiento){

        $this->firmaConsentimiento1 = $this->documento.uniqid() ."_child.png";
        $this->firmaDesistimiento = $this->documento.uniqid()."_child.png";

        $path1 = "firmas/".$this->firmaConsentimiento1;
        $path2 = "firmas/".$this->firmaDesistimiento;

        $status1 = file_put_contents($path1,base64_decode($imagenConsentimiento));
        $status2 = file_put_contents($path2,base64_decode($imagenDesistimiento));

        $this->mostrarconsentimientoChild = false;
        //$this->emit('habilitar-boton');
        
        return $this->generarDocumentosChild();
    }
    
    public function guardarFirmaTercera($imagenConsentimiento,$imagenDesistimiento){

        $this->firmaConsentimiento1 = $this->documento.uniqid() ."_tercera.png";
        $this->firmaDesistimiento = $this->documento.uniqid()."_tercera.png";

        $path1 = "firmas/".$this->firmaConsentimiento1;
        $path2 = "firmas/".$this->firmaDesistimiento;

        $status1 = file_put_contents($path1,base64_decode($imagenConsentimiento));
        $status2 = file_put_contents($path2,base64_decode($imagenDesistimiento));

        $this->mostrarconsentimientoTercera = false;
        //$this->emit('habilitar-boton');
        
        return $this->generarDocumentosTercera();
    }
    
    public function guardarFirma1ra2da18mas($imagenConsentimiento,$imagenDesistimiento){

        $this->firmaConsentimiento1 = $this->documento.uniqid() ."_1ra2da18mas.png";
        $this->firmaDesistimiento = $this->documento.uniqid()."_1ra2da18mas.png";

        $fecha_dir = date('y-m-d');
            
        if(!file_exists('firmas/' . $fecha_dir)){
            File::makeDirectory('firmas/' . $fecha_dir);
        }

        $path1 = "firmas/".$fecha_dir."/".$this->firmaConsentimiento1;
        $path2 = "firmas/".$fecha_dir."/".$this->firmaDesistimiento;

        $status1 = file_put_contents($path1,base64_decode($imagenConsentimiento));
        $status2 = file_put_contents($path2,base64_decode($imagenDesistimiento));

        $this->mostrarconsentimiento1ra2da18mas = false;
        //$this->emit('habilitar-boton');
        
        return $this->generarDocumentosFisico('1ra2da18mas');
    }
    public function guardarFirma511($imagenConsentimiento,$imagenDesistimiento,$tutor){

        $this->firmaConsentimiento1 = $this->documento.uniqid() ."__511.png";
        $this->firmaDesistimiento = $this->documento.uniqid()."__511.png";
        $this->tutor = $tutor;

        $fecha_dir = date('y-m-d');
            
        if(!file_exists('firmas/' . $fecha_dir)){
            File::makeDirectory('firmas/' . $fecha_dir);
        }

        $path1 = "firmas/".$fecha_dir."/".$this->firmaConsentimiento1;
        $path2 = "firmas/".$fecha_dir."/".$this->firmaDesistimiento;

        $status1 = file_put_contents($path1,base64_decode($imagenConsentimiento));
        $status2 = file_put_contents($path2,base64_decode($imagenDesistimiento));

        $this->mostrarconsentimiento511 = false;
        //$this->emit('habilitar-boton');
        
        return $this->generarDocumentosFisico('511');
    }
    /*
    public function guardarFirma1217($imagenConsentimiento,$imagenDesistimiento){

        $this->firmaConsentimiento1 = $this->documento.uniqid() ."__1217.png";
        $this->firmaDesistimiento = $this->documento.uniqid()."__1217.png";

        $fecha_dir = date('y-m-d');
            
        if(!file_exists('firmas/' . $fecha_dir)){
            File::makeDirectory('firmas/' . $fecha_dir);
        }

        $path1 = "firmas/".$fecha_dir."/".$this->firmaConsentimiento1;
        $path2 = "firmas/".$fecha_dir."/".$this->firmaDesistimiento;

        $status1 = file_put_contents($path1,base64_decode($imagenConsentimiento));
        $status2 = file_put_contents($path2,base64_decode($imagenDesistimiento));

        $this->mostrarconsentimiento511 = false;
        //$this->emit('habilitar-boton');
        
        return $this->generarDocumentosFisico('1217');
    }*/
    public function guardarFirmaCodex($imagenConsentimiento,$imagenDesistimiento,$codex){

        $this->firmaConsentimiento1 = $this->documento.uniqid() ."__".$codex.".png";
        $this->firmaDesistimiento = $this->documento.uniqid()."__".$codex.".png";

        $fecha_dir = date('y-m-d');
            
        if(!file_exists('firmas/' . $fecha_dir)){
            File::makeDirectory('firmas/' . $fecha_dir);
        }

        $path1 = "firmas/".$fecha_dir."/".$this->firmaConsentimiento1;
        $path2 = "firmas/".$fecha_dir."/".$this->firmaDesistimiento;

        $status1 = file_put_contents($path1,base64_decode($imagenConsentimiento));
        $status2 = file_put_contents($path2,base64_decode($imagenDesistimiento));

        $this->mostrarconsentimiento511 = false;
        $this->mostrarconsentimiento1217 = false;
        //$this->emit('habilitar-boton');
        
        return $this->generarDocumentosFisico($codex);
    }
    public function guardarFirma2(){
        //$this->firmaConsentimiento2 = $this->documento.uniqid().".png";
        //$path1 = "firmas/".$this->firmaConsentimiento2;
        //$status1 = file_put_contents($path1,base64_decode($imagenConsentimiento));
        $this->mostrarconsentimiento14b = false;

        return $this->generarDocumentos();
    }
    public function generarDocumentosSin(){
        $data = [
            'documento1_redgerencia' => $this->documento1_redgerencia,
            'documento1_establecimiento' => $this->documento1_establecimiento,
            'nombres' => $this->nombres,
            'edad' => $this->edad,
            'documento' => $this->documento,
            'telefono' => $this->telefono,
            'domicilio' => $this->domicilio,
            'sin_documento2_pre1'=>$this->sin_documento2_pre1,
            'sin_documento2_pre2'=>$this->sin_documento2_pre2,
            'sin_documento2_pre3'=>$this->sin_documento2_pre3,
            'archivosAdjuntos' => $this->archivosAdjuntos,
            'sin_documento3_pre1'=>$this->sin_documento3_pre1,
            'sin_documento3_pre2'=>$this->sin_documento3_pre2,
            'sin_documento3_pre3'=>$this->sin_documento3_pre3,

            'documento3_pre1'=>$this->documento3_pre1,
            'documento3_pre2'=>$this->documento3_pre2,
            'documento3_pre3'=>$this->documento3_pre3,
            'documento3_pre4'=>$this->documento3_pre4,
            'documento3_pre5'=>$this->documento3_pre5,
            'documento3_pre6'=>$this->documento3_pre6,
            'documento3_pre7'=>$this->documento3_pre7,
            'documento3_pre8'=>$this->documento3_pre8,
            'documento3_pre9'=>$this->documento3_pre9,

            'documento4_pre1'=>$this->documento4_pre1,
            'documento4_pre2'=>$this->documento4_pre2,
            'documento4_pre3'=>$this->documento4_pre3,
            'documento4_pre4'=>$this->documento4_pre4,
            'documento4_pre5'=>$this->documento4_pre5,
            'documento4_pre6'=>$this->documento4_pre6,
            'documento4_pre7'=>$this->documento4_pre7,

            'firmaConsentimiento1'=>$this->firmaConsentimiento1,
            'firmaDesistimiento'=>$this->firmaDesistimiento,

            'firmartraije'=>$this->firmartraije,
        ];

        $nombreSede = '';

        if($this->documento1_establecimiento!=null && $this->documento1_redgerencia!=null){
            $nombreSede = mb_strtoupper($this->documento1_redgerencia) . ' - ' . mb_strtoupper($this->documento1_establecimiento);
        }


        $customPaper = array(0,0,595.28,841.89);

        $fecha_dir = date('y-m-d');
            
        if(!file_exists('docs/' . $fecha_dir)){
            File::makeDirectory('docs/' . $fecha_dir);
        }

        $this->documento_nombre_1 = $fecha_dir . '/' .  $nombreSede . ' - ' . $this->nombres . ' - CONSENTIMIENTO.pdf';

        $pdf_documento1 = PDF::loadView('snippets.consentimientosin_mix_pdf', $data)
        ->setPaper($customPaper)->save('docs/'. $this->documento_nombre_1);

        
        $usuarioAtendido = UsuarioAtendido::find($this->registro_id);

        if ($usuarioAtendido->documentos()!=null) {
            if($usuarioAtendido->documentos()->count()>0){
                //update
                Documento::where(['usuariosatendido_id'=>$this->registro_id])->update([
                    'documento_nombre_1'=>$this->documento_nombre_1,
                ]);
            }else{
               
                $registered = $usuarioAtendido->documentos()->create([
                    'documento_nombre_1'=>$this->documento_nombre_1,
                ]);
            }
            
        }

        //ACTUALIZAR ESTADO A TRIAJE
        $usuarioAtendido->update([
            'triaje_dni'=>Auth::user()->dni,
            'triaje'=>Auth::user()->name,
            'horatriaje'=>date('g:i A'),
            'estado'=>'TRIAJE',
        ]);

        //actualizacion: ahora despues de registrar el triaje debe quedar limpio
        $this->nombres = null;
        $this->fechanacimiento = null;
        $this->grupoderiesgo = null;
        $this->edad = null;
        $this->dosis = null;
        $this->domicilio = null;
        $this->telefono = null;
        $this->registro_id = null;
        $this->documentos = null;
        $this->documento = null;
        $this->setdocumento = null;
        $this->documentos_totales = null;
        $this->archivosAdjuntos = null;
    }
    public function generarDocumentosChild(){
        $data = [
            'documento1_redgerencia' => $this->documento1_redgerencia,
            'documento1_establecimiento' => $this->documento1_establecimiento,
            'nombres' => $this->nombres,
            'edad' => $this->edad,
            'documento' => $this->documento,
            'telefono' => $this->telefono,
            'domicilio' => $this->domicilio,
            'archivosAdjuntos' => $this->archivosAdjuntos,
            'child_documento2_pre1'=>$this->child_documento2_pre1,
            'child_documento2_pre2'=>$this->child_documento2_pre2,
            'child_documento2_pre3'=>$this->child_documento2_pre3,
            
            'companion_documento'=>$this->companion_documento,
            'companion_tipo'=>$this->companion_tipo,
            'companion_nombres'=>$this->companion_nombres,


            'firmaConsentimiento1'=>$this->firmaConsentimiento1,
            'firmaDesistimiento'=>$this->firmaDesistimiento,

            'firmartraije'=>$this->firmartraije,
            'check_ninio_adolescente' => $this->estado_edad
        ];

        $nombreSede = '';

        if($this->documento1_establecimiento!=null && $this->documento1_redgerencia!=null){
            $nombreSede = mb_strtoupper($this->documento1_redgerencia) . ' - ' . mb_strtoupper($this->documento1_establecimiento);
        }

        $customPaper = array(0,0,595.28,841.89);

        $fecha_dir = date('y-m-d');
            
        if(!file_exists('docs/' . $fecha_dir)){
            File::makeDirectory('docs/' . $fecha_dir);
        }

        $this->documento_nombre_1 = $fecha_dir . '/' .  $nombreSede . '_' . $this->nombres . '_CONSENTIMIENTO_MENOR.pdf';

        $pdf_documento1 = PDF::loadView('snippets.consentimientochild_mix_pdf', $data)
        ->setPaper($customPaper)->save('docs/'. $this->documento_nombre_1);

     
        $usuarioAtendido = UsuarioAtendido::find($this->registro_id);

        if ($usuarioAtendido->documentos()!=null) {
            if($usuarioAtendido->documentos()->count()>0){
                //update
                Documento::where(['usuariosatendido_id'=>$this->registro_id])->update([
                    'documento_nombre_1'=>$this->documento_nombre_1,
                ]);
            }else{
               
                $registered = $usuarioAtendido->documentos()->create([
                    'documento_nombre_1'=>$this->documento_nombre_1,
                ]);
            }
            
        }

        //ACTUALIZAR ESTADO A TRIAJE
        $usuarioAtendido->update([
            'triaje_dni'=>Auth::user()->dni,
            'triaje'=>Auth::user()->name,
            'horatriaje'=>date('g:i A'),
            'estado'=>'TRIAJE',
        ]);

        //actualizacion: ahora despues de registrar el triaje debe quedar limpio
        $this->nombres = null;
        $this->fechanacimiento = null;
        $this->grupoderiesgo = null;
        $this->edad = null;
        $this->dosis = null;
        $this->domicilio = null;
        $this->telefono = null;
        $this->registro_id = null;
        $this->documentos = null;
        $this->documento = null;
        $this->setdocumento = null;
        $this->documentos_totales = null;
        $this->archivosAdjuntos = null;

    }
    public function generarDocumentosFisico($tipoConsentimiento){
        $data = [
            'documento1_redgerencia' => $this->documento1_redgerencia,
            'documento1_establecimiento' => $this->documento1_establecimiento,
            'nombres' => $this->nombres,
            'edad' => $this->edad,
            'documento' => $this->documento,
            'telefono' => $this->telefono,
            'domicilio' => $this->domicilio,
            'archivosAdjuntos' => $this->archivosAdjuntos,
            'child_documento2_pre1'=>$this->child_documento2_pre1,
            'child_documento2_pre2'=>$this->child_documento2_pre2,
            'child_documento2_pre3'=>$this->child_documento2_pre3,

            'grupoderiesgo'=>$this->grupoderiesgo,
            
            'companion_documento'=>$this->companion_documento,
            'companion_tipo'=>$this->companion_tipo,
            'companion_nombres'=>$this->companion_nombres,


            'firmaConsentimiento1'=>$this->firmaConsentimiento1,
            'firmaDesistimiento'=>$this->firmaDesistimiento,

            'firmartraije'=>$this->firmartraije,

            'check_ninio_adolescente' => $this->estado_edad,

            'tutor' => $this->tutor,
        ];

        $nombreSede = '';

        if($this->documento1_establecimiento!=null && $this->documento1_redgerencia!=null){
            $nombreSede = mb_strtoupper($this->documento1_redgerencia) . ' - ' . mb_strtoupper($this->documento1_establecimiento);
        }

        $customPaper = array(0,0,595.28,841.89);

        $fecha_dir = date('y-m-d');
            
        if(!file_exists('docs/' . $fecha_dir)){
            File::makeDirectory('docs/' . $fecha_dir);
        }

        $this->documento_nombre_1 = $fecha_dir . '/' .  $nombreSede . '_' . $this->nombres . '_CONSENTIMIENTO.pdf';

        $docpdf = '';

        switch ($tipoConsentimiento) {
            case '1ra2da18mas':
                $docpdf = 'consentimiento1ra2da18mas_pdf';
                break;
            case '511':
                $docpdf = 'consentimiento511_pdf';
                break;
            case '1217':
                $docpdf = 'consentimiento1217_pdf';
                break;
            default:
                $docpdf = 'consentimientotres_mix_pdf';
                break;
        }

        $pdf_documento1 = PDF::loadView("snippets.$docpdf", $data)
        ->setPaper($customPaper)->save('docs/'. $this->documento_nombre_1);

    

        $usuarioAtendido = UsuarioAtendido::find($this->registro_id);

        if ($usuarioAtendido->documentos()!=null) {
            if($usuarioAtendido->documentos()->count()>0){
                //update
                Documento::where(['usuariosatendido_id'=>$this->registro_id])->update([
                    'documento_nombre_1'=>$this->documento_nombre_1,
                ]);
            }else{
               
                $registered = $usuarioAtendido->documentos()->create([
                    'documento_nombre_1'=>$this->documento_nombre_1,
                ]);
            }
            
        }

        //ACTUALIZAR ESTADO A TRIAJE
        $usuarioAtendido->update([
            'triaje_dni'=>Auth::user()->dni,
            'triaje'=>Auth::user()->name,
            'horatriaje'=>date('g:i A'),
            'estado'=>'TRIAJE',
        ]);

        //actualizacion: ahora despues de registrar el triaje debe quedar limpio
        $this->nombres = null;
        $this->fechanacimiento = null;
        $this->grupoderiesgo = null;
        $this->edad = null;
        $this->dosis = null;
        $this->domicilio = null;
        $this->telefono = null;
        $this->registro_id = null;
        $this->documentos = null;
        $this->documento = null;
        $this->setdocumento = null;
        $this->documentos_totales = null;
        $this->archivosAdjuntos = null;
    }
    public function generarDocumentosTercera(){

        
        $data = [
            'documento1_redgerencia' => $this->documento1_redgerencia,
            'documento1_establecimiento' => $this->documento1_establecimiento,
            'nombres' => $this->nombres,
            'edad' => $this->edad,
            'documento' => $this->documento,
            'telefono' => $this->telefono,
            'domicilio' => $this->domicilio,
            'archivosAdjuntos' => $this->archivosAdjuntos,
            'child_documento2_pre1'=>$this->child_documento2_pre1,
            'child_documento2_pre2'=>$this->child_documento2_pre2,
            'child_documento2_pre3'=>$this->child_documento2_pre3,

            'grupoderiesgo'=>$this->grupoderiesgo,
            
            'companion_documento'=>$this->companion_documento,
            'companion_tipo'=>$this->companion_tipo,
            'companion_nombres'=>$this->companion_nombres,


            'firmaConsentimiento1'=>$this->firmaConsentimiento1,
            'firmaDesistimiento'=>$this->firmaDesistimiento,

            'firmartraije'=>$this->firmartraije,

            'check_ninio_adolescente' => $this->estado_edad
        ];

        $nombreSede = '';

        if($this->documento1_establecimiento!=null && $this->documento1_redgerencia!=null){
            $nombreSede = mb_strtoupper($this->documento1_redgerencia) . ' - ' . mb_strtoupper($this->documento1_establecimiento);
        }

        $customPaper = array(0,0,595.28,841.89);

        $fecha_dir = date('y-m-d');
            
        if(!file_exists('docs/' . $fecha_dir)){
            File::makeDirectory('docs/' . $fecha_dir);
        }

        $this->documento_nombre_1 = $fecha_dir . '/' .  $nombreSede . '_' . $this->nombres . '_CONSENTIMIENTO_TRES.pdf';

        $pdf_documento1 = PDF::loadView('snippets.consentimientotres_mix_pdf', $data)
        ->setPaper($customPaper)->save('docs/'. $this->documento_nombre_1);

        $usuarioAtendido = UsuarioAtendido::find($this->registro_id);

        if ($usuarioAtendido->documentos()!=null) {
            if($usuarioAtendido->documentos()->count()>0){
                //update
                Documento::where(['usuariosatendido_id'=>$this->registro_id])->update([
                    'documento_nombre_1'=>$this->documento_nombre_1,
                ]);
            }else{
               
                $registered = $usuarioAtendido->documentos()->create([
                    'documento_nombre_1'=>$this->documento_nombre_1,
                ]);
            }
            
        }

        //ACTUALIZAR ESTADO A TRIAJE
        $usuarioAtendido->update([
            'triaje_dni'=>Auth::user()->dni,
            'triaje'=>Auth::user()->name,
            'horatriaje'=>date('g:i A'),
            'estado'=>'TRIAJE',
        ]);

        //actualizacion: ahora despues de registrar el triaje debe quedar limpio
        $this->nombres = null;
        $this->fechanacimiento = null;
        $this->grupoderiesgo = null;
        $this->edad = null;
        $this->dosis = null;
        $this->domicilio = null;
        $this->telefono = null;
        $this->registro_id = null;
        $this->documentos = null;
        $this->documento = null;
        $this->setdocumento = null;
        $this->documentos_totales = null;
        $this->archivosAdjuntos = null;

    }
    public function generarDocumentos(){

        
        $data = [
            'documento1_redgerencia' => $this->documento1_redgerencia,
            'documento1_establecimiento' => $this->documento1_establecimiento,
            'nombres' => $this->nombres,
            'edad' => $this->edad,
            'documento' => $this->documento,
            'telefono' => $this->telefono,
            'domicilio' => $this->domicilio,
            'archivosAdjuntos' => $this->archivosAdjuntos,
            'documento1_pre1'=>$this->documento1_pre1,
            'documento1_pre2'=>$this->documento1_pre2,
            'documento1_pre3'=>$this->documento1_pre3,
            'documento2_pre1'=>$this->documento2_pre1,
            'documento2_pre2'=>$this->documento2_pre2,
            'documento2_pre3'=>$this->documento2_pre3,
            'firmaConsentimiento1'=>$this->firmaConsentimiento1,
            'firmaConsentimiento2'=>$this->firmaConsentimiento2,
            'firmaDesistimiento'=>$this->firmaDesistimiento,
            'companion_tipodocumento'=>$this->companion_tipodocumento,
            'companion_documento'=>$this->companion_documento,
            'companion_telefono'=>$this->companion_telefono,
            'companion_nombres'=>$this->companion_nombres,
            'companion_tipo'=>$this->companion_tipo,
            'firmartraije'=>$this->firmartraije,
        ];

        $nombreSede = '';

        if($this->documento1_establecimiento!=null && $this->documento1_redgerencia!=null){
            $nombreSede = mb_strtoupper($this->documento1_redgerencia) . ' - ' . mb_strtoupper($this->documento1_establecimiento);
        }
        
        

        $customPaper = array(0,0,595.28,841.89);

        $fecha_dir = date('y-m-d');
            
        if(!file_exists('docs/' . $fecha_dir)){
            File::makeDirectory('docs/' . $fecha_dir . '/');
        }

        $this->documento_nombre_1 = $fecha_dir . '/' . $nombreSede . ' - ' . $this->nombres . ' - CONSENTIMIENTO.pdf';

        $pdf_documento1 = PDF::loadView('snippets.consentimiento_mix_pdf', $data)
        ->setPaper($customPaper)->save('docs/' . $this->documento_nombre_1);

        $usuarioAtendido = UsuarioAtendido::find($this->registro_id);


        if($usuarioAtendido->documentos()->count()>0){
            //update
            Documento::where(['usuariosatendido_id'=>$this->registro_id])->update([
                'documento_nombre_1'=>$this->documento_nombre_1,
            ]);
        }else{
            $usuarioAtendido->documentos()->create([
                'documento_nombre_1'=>$this->documento_nombre_1,
            ]);
        }

        //ACTUALIZAR ESTADO A TRIAJE
        $usuarioAtendido->update([
            'triaje_dni'=>Auth::user()->dni,
            'triaje'=>Auth::user()->name,
            'horatriaje'=>date('g:i A'),
            'estado'=>'TRIAJE',
        ]);


        $this->mostrarconsentimiento = false;
        $this->mostrarconsentimiento14b = false;
        $this->mostrarconsentimiento14a = false;

        //$this->documentos = Documento::where(['usuariosatendido_id'=>$this->registro_id])->get();

        //actualizacion: ahora despues de registrar el triaje debe quedar limpio
        $this->nombres = null;
        $this->fechanacimiento = null;
        $this->grupoderiesgo = null;
        $this->edad = null;
        $this->dosis = null;
        $this->domicilio = null;
        $this->telefono = null;
        $this->registro_id = null;
        $this->documentos = null;
        $this->documento = null;
        $this->setdocumento = null;
        $this->documentos_totales = null;
        $this->archivosAdjuntos = null;

    }
    public function getdoc1firma($cualfirma){
        $event='generar-firma';
        $this->emit($event,$cualfirma);
    }
    public function getdoc1firmaSin($cualfirma){
        $event='generar-firma-sin';
        $this->emit($event,$cualfirma);
    }
    public function getdoc1firmaTres($cualfirma){
        $event='generar-firma-tres';
        $this->emit($event,$cualfirma);
    }
    public function getdoclafirma($evento,$cualfirma){
        
        $this->emit($evento,$cualfirma);
    }
    public function getdoc1firmaChild($cualfirma){
        $event='generar-firma-child';
        $this->emit($event,$cualfirma);
    }
    
}
