<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Rede;
use App\Models\Establecimiento;

class SedeTable extends Component
{
    use WithPagination;

    public $rede_id;
    public $nombre;
    public $tiempoespera;

    public $selectGerencia;
    public $establecimientoId;

    public $optionsopened;

    public function render()
    {
        $redes = Rede::where([
            'estado'=>'1'
        ])->get();

        $establecimientos = Rede::with(['establecimientos'])->get();
        //$establecimientos = Establecimiento::with(['redes'])->paginate();
        
        return view('livewire.sede-table',[
            'redes'=>$redes,
            'establecimientos'=>$establecimientos,
            //'establecimientos'=>$establecimientos,
        ]);
    }
    
    protected $rules = [
        'rede_id' => 'required',
        'nombre' => 'required|max:255',
        'tiempoespera' => 'required|numeric',
    ];

    protected $messages = [
        'rede_id.required' => 'Debe elegir una Sede',
        'nombre.required' => 'Debe escribir el nombre de su establecimiento',
        'tiempoespera.required' => 'Debe colocar el tiempo en minutos',
        'tiempoespera.numeric' => 'Debe colocar solo números',
    ];

    public function store(){
        $this->validate();
        
        $rede_id = null;

        //buscar primero en red si existe, sino, agregarlo como nuevo
        $searchFromRede = Rede::where(['redgerencia'=>$this->rede_id])->first();
        if($searchFromRede!=null){
            $rede_id = $searchFromRede->id;
        }else{
            $newRede = Rede::create([
                'redgerencia'=>$this->rede_id
            ]);
            $rede_id = $newRede->id;
        }

        Establecimiento::updateOrCreate(['id'=>$this->establecimientoId],[
            'rede_id'=>$rede_id,
            'nombre'=>$this->nombre,
            'tiempoespera'=>$this->tiempoespera,
        ]);

        $this->establecimientoId = null;
        $this->nombre = null;
        $this->tiempoespera = null;
        $this->rede_id = null;
        
    }
    public function editar($establecimiento_id){
        
        
        $est = Establecimiento::find($establecimiento_id);
        if($est!=null){
            
            $nombre_red = Rede::find($this->rede_id);
            if($nombre_red!=null){
                $this->rede_id = $nombre_red->redgerencia;
            }

            $this->establecimientoId = $establecimiento_id;
            $this->nombre = $est->nombre;
            $this->tiempoespera = $est->tiempoespera;

        }
        
    }
    public function set_red_id($rede_id){
        $this->rede_id = $rede_id;
        $this->optionsopened = false;
    }
    public function active($establecimiento_id,$estado){
        Establecimiento::find($establecimiento_id)->update([
            'estado'=>$estado
        ]);
    }
    public function eliminarreg($rede_id){
        Rede::find($rede_id)->delete();
        
    }
    public function eliminar($establecimiento_id){
        Establecimiento::find($establecimiento_id)->delete();
    }
    public function openred(){
        $this->optionsopened = true;
    }
}
