<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MonitoreoController extends Controller
{
    //
    public $modulo;

    public function panel(){
        
        if(Auth::user()->type!='enfermero'){
            return view('error_',['message'=>'No tiene permiso a este panel']);
        }
        return view('monitoreo.panel');
    }
}
