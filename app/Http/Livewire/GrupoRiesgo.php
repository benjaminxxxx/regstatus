<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Riesgo;
use File;

class GrupoRiesgo extends Component
{
    use WithFileUploads;

    public $file;
    public $file2;
    public $filename;
    public $filename2;
    public $riesgoId;

    public $pemax;
    public $pemin;
    public $pegrupoderiesgo;

    public $prgrupoderiesgo;

    public $poreliminar;
    public $preguntarporeliminar = false;

    protected $listeners = ['agregarimagen','agregarimagen2'];

    public function render()
    {
        $vacunasPorEdades = Riesgo::where(['tiporiesgo'=>1])->orderBy('orden','asc')->get();
        $vacunasPorRiesgo = Riesgo::where(['tiporiesgo'=>2])->get();

        return view('livewire.grupo-riesgo',[
            'vacunasPorEdades'=>$vacunasPorEdades,
            'vacunasPorRiesgo'=>$vacunasPorRiesgo,
        ]);
    }
    public function agregarimagen(){
    
        if($this->file!=null){
            $name = $this->file->getClientOriginalName();
            $newName = uniqid().'_'.$name;
            $this->file->storeAs('grupoderiesgo',$newName,$disk = 'public');
            $this->filename = $newName;
        }
    }
    public function agregarimagen2(){
    
        if($this->file2!=null){
            $name = $this->file2->getClientOriginalName();
            $newName = uniqid().'_'.$name;
            $this->file2->storeAs('grupoderiesgo',$newName,$disk = 'public');
            $this->filename2 = $newName;
        }
    }
    public function eliminarFile($esRiesgo = 1){
        if($esRiesgo==1){
            $this->filename = null;
        }else{
            $this->filename2 = null;
        }
    }
    public function eliminar(){
        Riesgo::find($this->poreliminar)->delete();
        $this->preguntarporeliminar = false;
    }
    public function antes_de_eliminar($id){
        $this->poreliminar = $id;
        $this->preguntarporeliminar = true;
    }
    public function store($tipoDeRiesgo){
        $getMaxOrd = Riesgo::where(['tiporiesgo'=>$tipoDeRiesgo])->max('orden');
        if($getMaxOrd==null){
            $getMaxOrd = 0;
        }

        $getMaxOrd++;

        if($tipoDeRiesgo==1){

            Riesgo::create([
                'riesgo'=>$this->pegrupoderiesgo,
                'min'=>$this->pemin,
                'max'=>$this->pemax,
                'logo'=>$this->filename,
                'orden'=>$getMaxOrd,
                'tiporiesgo'=>$tipoDeRiesgo
            ]);

            $this->filename = null;
            $this->pemax = null;
            $this->pemin = null;
            $this->pegrupoderiesgo = null;

        }

        if($tipoDeRiesgo==2){

            Riesgo::create([
                'riesgo'=>$this->prgrupoderiesgo,
                'logo'=>$this->filename2,
                'orden'=>$getMaxOrd,
                'tiporiesgo'=>$tipoDeRiesgo
            ]);

            $this->filename2 = null;
            $this->prgrupoderiesgo = null;

        }
    }
}
