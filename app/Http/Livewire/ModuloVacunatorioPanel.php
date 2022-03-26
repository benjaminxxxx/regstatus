<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Riesgo;
use App\Models\UsuarioAtendido;
use App\Models\Marca;
use App\Models\User;
use App\Models\Documento;
use App\Models\Establecimiento;
use Livewire\WithPagination;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Auth;
use PDF;
use File;

class ModuloVacunatorioPanel extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $registro_id;

    public $tipodocumento;
    public $documento;
    public $nombres;
    public $telefono;
    public $fechanacimiento;
    public $grupoderiesgo;
    public $edad;
    public $domicilio;


    public $marca;
    public $lote;
    public $dosis;

    public $registros;
    public $hayMasUsuario = false;
    public $documentos;

    public $documentos_totales;
    public $setdocumento;

    public function render()
    {
        /*
        TENGO ACCESO A ESOS DATOS: VIENEN DE SELECCIONARESTACIONTRABAJO.PHP

        session()->put('establecimiento_id',$this->establecimiento_id);
        session()->put('area_de_trabajo',$this->seleccionado);
        session()->put('estacion_id',$this->estacion_id);
        session()->put('vacunador_id',$this->vacunador_id);
        session()->put('vacunador_nombre',$this->textvacunador);
        session()->put('modulo_vacunatorio',$modulo_vacunatorio_text);

        "establecimiento_id" => 6
        "area_de_trabajo" => "vacunatorio"
        "estacion_id" => "1"
        "vacunador_id" => 10
        "vacunador_nombre" => "ENFERMERITO"
        "modulo_vacunatorio" => "AV1"
        session()->get('vacunador_nombre')
        session()->get('establecimiento_id')
         */

        $establecimiento_id = session()->get('establecimiento_id');
        $modulo_vacunatorio = session()->get('modulo_vacunatorio');

        //dd($modulo_admision);
     
        $riesgos = Riesgo::all();
        $marcas = Marca::all();

        //$pacientes = UsuarioAtendido::where()->with(['archivos_adjuntos','companions'])->paginate(20);
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

        $where = [
            //'estado'=>'TRIAJE',
            'establecimiento_id'=>$establecimiento_id, 'modulo_vacunatorio'=>$modulo_vacunatorio,
        ];

        $usuariosTriaje = UsuarioAtendido::where([
            'estado'=>'TRIAJE',
            'establecimiento_id'=>$establecimiento_id,
        ])->orderBy('updated_at','desc')->paginate(10);
        $usuariosVacunados = UsuarioAtendido::where([
            'estado'=>'VACUNADO',
            'establecimiento_id'=>$establecimiento_id, 
            'modulo_vacunatorio'=>$modulo_vacunatorio
        ])->with(['documentos'])->orderBy('updated_at','desc')->paginate(6);

        $dispositivo = $this->tipo_dispositivo();


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

        return view('livewire.modulo-vacunatorio-panel',[
            'riesgos'=>$riesgos,
            'usuariosTriaje'=>$usuariosTriaje,
            'marcas'=>$marcas,
            'usuariosVacunados'=>$usuariosVacunados,
            'documentos'=>$this->documentos,
            'dispositivo' => $dispositivo
        ]);
    }
    public function eliminardocumentos($docs_id){
        
        $all_docs = Documento::find($docs_id);


        if($all_docs!=null){
            $image_path1 = public_path("docs/" . $all_docs->documento_nombre_1);
            $image_path2 = public_path("docs/" . $all_docs->documento_nombre_2);

            if(File::exists($image_path1)) {
                File::delete($image_path1);
            }
            if(File::exists($image_path2)) {
                File::delete($image_path2);
            }
            $all_docs->delete();
            
        }
        //$this->render();
    }
    public function tipo_dispositivo(){
        $tablet_browser = 0;
        $mobile_browser = 0;
        $body_class = 'desktop';
        
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
            $body_class = "tablet";
        }
        
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
            $body_class = "mobile";
        }
        
        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
            $body_class = "mobile";
        }
        
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
            'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
            'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
            'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
            'newt','noki','palm','pana','pant','phil','play','port','prox',
            'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
            'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
            'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
            'wapr','webc','winw','winw','xda ','xda-');
        
        if (in_array($mobile_ua,$mobile_agents)) {
            $mobile_browser++;
        }
        
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
            $mobile_browser++;
            //Check for tablets on opera mini alternative headers
            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
            $tablet_browser++;
            }
        }
        if ($tablet_browser > 0) {
        // Si es tablet has lo que necesites
            return 'tablet';
        }
        else if ($mobile_browser > 0) {
        // Si es dispositivo mobil has lo que necesites
            return 'mobile';
        }
        else {
        // Si es ordenador de escritorio has lo que necesites
            return 'desktop';
        }  
    }
    public function store(){

        //buscar grupo de riesgo, y si no existe, debemos guardarlo
        /*$riesgos = Riesgo::where(['riesgo'=>$this->grupoderiesgo])->first();
        if($riesgos==null){
            //guardarlos
            Riesgo::create([
                'riesgo'=> mb_strtoupper($this->grupoderiesgo)
            ]);
        }
        */
        
        $fechahora = date("Y-m-d H:i:s");

        $arrData = [
            'tipodocumento'=>$this->tipodocumento,
            'documento'=>$this->documento,
            //'grupoderiesgo'=>$this->grupoderiesgo, //bloqueado por seguridad
            'domicilio'=>$this->domicilio,
            'marca'=>$this->marca,
            'lote'=>$this->lote,
            'dosis'=>$this->dosis,
            'estado'=>'VACUNADO',
            'modulo_vacunatorio'=>session()->get('modulo_vacunatorio'),
            'establecimiento_id'=>session()->get('establecimiento_id'),
            'digitador'=> mb_strtoupper(Auth::user()->name),
            'digitador_dni'=> mb_strtoupper(Auth::user()->dni),
            'fechahora'=>$fechahora,
            'vacunador_id'=>session()->get('vacunador_id'),
            'licenciado'=>session()->get('vacunador_nombre')
        ];


        try {

            /*************GENERANDO CONSTANCIA*****************/
            
            $establecimiento_id = session()->get('establecimiento_id');
            //se necesita extraer el nombre completo de la sede
            $datosEstablecimiento = Establecimiento::find($establecimiento_id);
            if($datosEstablecimiento->rede!=null){
                $nombreSede = mb_strtoupper($datosEstablecimiento->rede->redgerencia) . ' - ' . mb_strtoupper($datosEstablecimiento->nombre);
            }
            //dd($datosEstablecimiento->rede->redgerencia);
            //extraer la firma del vacunador tambien
            $user_id_vacunador = session()->get('vacunador_id');
            $datos_user_vacunador = User::find($user_id_vacunador);
            
            $firma = '';

            if($datos_user_vacunador!=null){
                $firma = $datos_user_vacunador->firma;
            }
            $data = [
                'nombre_sede' => $nombreSede,
                'nombres' => $this->nombres,
                'fecha_nacimiento' => date('d/m/Y',strtotime($this->fechanacimiento)),
                'edad' => $this->edad,
                'tipodocumento' => $this->tipodocumento,
                'documento' => $this->documento,
                'telefono' => $this->telefono,
                'dosis' => $this->dosis,
                'fecha_vacunacion'=> date('d/m/Y',strtotime($fechahora)),
                'marca' => $this->marca,
                'lote' => $this->lote,
                'firma_vacunador'=>$firma
            ];

            $this->documentos_totales = null;

            $fecha_dir = date('y-m-d',strtotime($fechahora));
            
            if(!file_exists('docs/' . $fecha_dir)){
                File::makeDirectory('docs/' . $fecha_dir . '/');
            }
            //if()

            //$documento_constancia = $nombreSede . '_con_' . $this->documento . '_' . uniqid() . '.pdf';
            $documento_constancia = $fecha_dir . '/' . $nombreSede . '-' . $this->nombres . '-CERTIFICADO.pdf';

            $documento_constancia = str_replace(' ','_',$documento_constancia);
            
            $customPaper = array(0,0,595.28,841.89);
            $pdf_documento1 = PDF::loadView('snippets.consentimiento_certificado', $data)
        ->setPaper($customPaper)->save('docs/' . $documento_constancia);
      
            /************FIN DE CONSTANCIA********************/
            $usuarioAtendido = UsuarioAtendido::find($this->registro_id);
            $usuarioAtendido->update($arrData);

            $documentos_cantidad = $usuarioAtendido->documentos()->count();
            if($documentos_cantidad>0){
                Documento::where(['usuariosatendido_id'=>$this->registro_id])->update([
                    'documento_nombre_2'=>$documento_constancia,
                ]);
            }
            
            $this->cancelar();
           
            request()->session()->flash('flash.banner', 'Paciente vacunado correctamente');
            request()->session()->flash('flash.bannerStyle', 'success');

        } catch (\Throwable $th) {
            request()->session()->flash('flash.banner', 'Error: El archivo no existe: ' . $th->getMessage());
            request()->session()->flash('flash.bannerStyle', 'danger');
        }

    }
    public function updateList(){
        $this->render();
    }
    function export($fileoriginal,$filename,$tipo= 'CONSENTIMIENTO'){
        try {
            $path = public_path('docs/'.$fileoriginal);
        
            return response()->download($path, $filename . ' - '.$tipo.'.pdf');
        } catch (\Throwable $th) {
            dd('El archivo no existe');
        }
        
    }
    function autoseleccionar($documento,$id=null){
        $this->documento = $documento;
        $this->hayMasUsuario = false;
        $this->buscarDeTriaje($id);
    }
    public function buscarDeTriaje($id=null){

        $arrWhere = [
            'documento'=>$this->documento,
            'estado'=>'TRIAJE',
            'establecimiento_id'=>session()->get('establecimiento_id')
        ];

        if($id!=null){
            $arrWhere['id'] = $id;
        }
        
        $usuario = UsuarioAtendido::with([
            'companions',
            'documentos'
        ])->where($arrWhere)->get();

        if($usuario->count()==0){
            
            $this->cancelar();

            request()->session()->flash('flash.banner', 'No se encontro al paciente');
            request()->session()->flash('flash.bannerStyle', 'danger');
            return;
        }

        request()->session()->flash('flash.banner', 'Se encontró al paciente');
        request()->session()->flash('flash.bannerStyle', 'success');
        
        if($usuario->count()==1){
            
            $usuario = UsuarioAtendido::with([
                'companions',
                'documentos'
            ])->where($arrWhere)->first();

            $this->registro_id = $usuario->id;
            $this->nombres = $usuario->nombres;
            $this->tipodocumento = $usuario->tipodocumento;
            $this->fechanacimiento = $usuario->fecha_nacimiento;
            $this->telefono = $usuario->telefono;
            $this->grupoderiesgo = $usuario->grupoderiesgo;
            $this->edad = $usuario->edad;
            $this->domicilio = $usuario->domicilio;


            $this->marca = $usuario->marca;
            $this->lote = $usuario->lote;
            $this->dosis = $usuario->dosis;

            $this->documentos = $usuario->documentos;
            $this->setdocumento = $usuario->documento;
            
            if($this->tipodocumento==null){
                $this->tipodocumento = 'dni';
            }
            return;
        }

        if($usuario->count()>1){
            
            
            $this->registros = $usuario;
            $this->hayMasUsuario = true;
            
        }
        
    }
    public function cancelar(){
        $this->nombres = null;
        $this->fechanacimiento = null;
        $this->grupoderiesgo = null;
        $this->edad = null;
        $this->domicilio = null;
        $this->telefono = null;
        $this->registro_id = null;

        $this->marca = null;
        $this->lote = null;
        $this->dosis = null;

        $this->documentos = null;
        $this->documentos_totales = null;
        $this->setdocumento = null;
    }
    public function elegirriesgo($riesgo){
      
        $this->grupoderiesgo = $riesgo;
    }
    public function eliminarriesgo($id){
        Riesgo::find($id)->delete();
    }
    public function liberar(){

        $user_id = session()->get('vacunador_id');

        $licenciado = User::where([
            'id'=>$user_id,
        ])->update([
            'ocupado_con'=>null,
            'fecha_ocupacion'=>null,
            'estado_labor'=>'DISPONIBLE',
        ]);
        
        session()->forget('establecimiento_id');
        session()->forget('area_de_trabajo');
        session()->forget('estacion_id');
        session()->forget('vacunador_id');
        session()->forget('vacunador_nombre');
        session()->forget('modulo_vacunatorio');

        return redirect()->route('dashboard');
    }
}
