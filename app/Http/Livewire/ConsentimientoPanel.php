<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Documento;
use App\Models\UsuarioAtendido;
use App\Models\Establecimiento;
use Livewire\WithPagination;
use File;

class ConsentimientoPanel extends Component
{
    use WithPagination;
    public $establecimientos;
    public $message;
    public $showmessage; 
    public $RegistrosSeleccionados;
    public $seleccionadosTodos;
    public $textoSeleccionarTodo = 'Seleccionar todo';
    public $documento;
    public $fecha;

    public function mount(){

        $this->RegistrosSeleccionados = [];
        $this->seleccionadosTodos = [];

        $establecimientos = Establecimiento::where(['estado'=>'1'])->get();
        $arrEst = [];
        if($establecimientos->count()>0){
            // foreach ($establecimientos as $establecimiento) {
            //     $arrEst
            // }
            $arrEst = $establecimientos->pluck('nombre','id')->all();
        }
        
        $this->establecimientos = $arrEst;
    }
    public function descargarDocumentos(){

        if(is_array($this->RegistrosSeleccionados) && count($this->RegistrosSeleccionados)>0){

            $zip_file = 'documentos.zip';

            if($this->fecha!='' && $this->fecha!=null){
                $zip_file = $this->fecha . '.zip';
            }

            $zip = new \ZipArchive();

            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            foreach ($this->RegistrosSeleccionados as $registroSeleccionado) {
                #cada usuario atendido tiene dos documentos
                $registro = UsuarioAtendido::where(['id'=>$registroSeleccionado])->with(['documentos'])->first();
                if($registro!=null){
                    $documentos = $registro->documentos;
                    if($documentos->count()>0){
                        foreach ($documentos as $documento) {
                            $consentimiento = $documento->documento_nombre_1;
                            $certificado = $documento->documento_nombre_1;
                            $paciente = $registro->nombres;

                            $path = public_path('docs/'.$consentimiento);
                            $path2 = public_path('docs/'.$certificado);

                            if(file_exists($path)){
                                $zip->addFile($path,$paciente . ' - CONSENTIMIENTO.pdf');
                            }
                            if(file_exists($path2)){
                                $zip->addFile($path2,$paciente . ' - CERTIFICADO.pdf');
                            }

                        }
                    }
                }
            }
            $zip->close();
            $this->RegistrosSeleccionados = [];
            $this->textoSeleccionarTodo = 'Seleccionar todo';
            request()->session()->flash('flash.banner', 'Todos los documentos se descargaron');
            request()->session()->flash('flash.bannerStyle', 'success');
            return response()->download($zip_file);
            
        }else{
            $this->showmessage = true;
            $this->message = 'Ningún documento seleccionado'; 
        }
    }
    public function export($fileoriginal,$filename,$tipo= 'CONSENTIMIENTO'){
        try {
            $path = public_path('docs/'.$fileoriginal);
        
            return response()->download($path, $filename . ' - '.$tipo.'.pdf');
        } catch (\Throwable $th) {
            $this->showmessage = true;
            $this->message = 'El archivo no existe';
        }
        
    }
    public function render()
    {
        //$documentos = Documento::with('usuarioatendido')->orderBy('created_at','desc')->paginate(100);
        $filter = [
            'estado'=>'vacunado'
        ];

        if($this->documento!=null && trim($this->documento)!=''){
            if(strlen($this->documento)>=7){
                $filter['documento']=$this->documento;
            }
            
        }

        $usuariosatendidos = UsuarioAtendido::with('documentos')
        ->where($filter)
        ->orderBy('fechahora','desc')->limit(10000)->get();

        if($this->fecha!=null && trim($this->fecha)!=''){
            $usuariosatendidos = UsuarioAtendido::with('documentos')
            ->whereDate('fechahora','=',$this->fecha)
            ->where($filter)
            ->orderBy('fechahora','desc')->limit(10000)->get();
        }
        
        $this->seleccionadosTodos = $usuariosatendidos->pluck('id')->all();
        
        return view('livewire.consentimiento-panel',[
            'usuariosatendidos'=>$usuariosatendidos
        ]);
    }
    public function seleccionar(){
        
        if($this->textoSeleccionarTodo=='Seleccionar todo'){
            
            $this->RegistrosSeleccionados = $this->seleccionadosTodos;
            $this->textoSeleccionarTodo = 'Deseleccionar todo';
        }else{
            $this->RegistrosSeleccionados = [];
            $this->textoSeleccionarTodo = 'Seleccionar todo';
        }
        
    }
    public function eliminar(){
        
        $documentos = Documento::whereIn('usuariosatendido_id',$this->RegistrosSeleccionados)->get();

        if($documentos->count()>0){
            foreach ($documentos as $documento) {
                $image_path = public_path("docs/" . $documento->documento_nombre_1);
                $image_path2 = public_path("docs/" . $documento->documento_nombre_2);

                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
                if(File::exists($image_path2)) {
                    File::delete($image_path2);
                }

                Documento::find($documento->id)->delete();
            }
            
        }
        $this->RegistrosSeleccionados = [];
        $this->textoSeleccionarTodo = 'Seleccionar todo';
    }
}
