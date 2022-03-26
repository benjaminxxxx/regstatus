<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;

class SeleccionarTriajeMonitoreo extends Component
{
    public function render()
    {
        /*request()->session()->flash('flash.banner', 'holaaaaaaaaaaaadssssssssssssssssssss');
        request()->session()->flash('flash.bannerStyle', 'error');*/
        return view('livewire.seleccionar-triaje-monitoreo');
    }
    public function choose($estacionDeTrabajo){

        $establecimiento_id = Auth::user()->establecimiento_id;
        if($establecimiento_id==null){
            return;
        }else{

            session()->put('area_de_trabajo',$estacionDeTrabajo);
            session()->put('establecimiento_id',$establecimiento_id);
            return redirect()->route('dashboard');
        }
        
    }
}
