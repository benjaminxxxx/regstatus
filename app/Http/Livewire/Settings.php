<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Modulo;
use App\Models\Marca;
use App\Models\UsuarioAtendido;
use App\Models\Establecimiento;
use Livewire\WithPagination;
use Auth;

class Settings extends Component
{
    use WithPagination;

    public $marca;
    
    //tablas
    public $total_marcas;
    public $establecimiento_id;
    public $sede_nombre;

    public function render()
    {


        $marcas = Marca::get();

        $this->total_marcas = Marca::all()->count();


        return view('livewire.settings',[
            'marcas'=>$marcas,
        ]);
    }
 
   
    public function store_marca()
    {
        
        Marca::create([
            'marca'=>$this->marca
        ]);
        $this->marca = null;
    }
 
   

    public function eliminar_marca($id){

        $this->marca = null;
        
        Marca::find($id)->delete();

    }


}
