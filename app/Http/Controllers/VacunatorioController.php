<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class VacunatorioController extends Controller
{
    //
    public function index(){
        
        return view('vacunatorio.table');
    }
    public function panel(){
       
        $establecimiento_id = session()->get('establecimiento_id');
        if(Auth::user()->type!='digitador'){
            return view('error_',['message'=>'No tiene permiso a este panel']);
        }
        if($establecimiento_id==null){
            session()->remove('area_de_trabajo');
            session()->remove('estacion_id');
            return redirect()->route('dashboard');
        }

        return view('vacunatorio.panel');
    }
}
