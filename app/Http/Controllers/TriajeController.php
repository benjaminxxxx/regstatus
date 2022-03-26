<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TriajeController extends Controller
{
    public function index(){

        if(Auth::user()->type!='enfermero'){
            return view('error_',['message'=>'No tiene permiso a este panel']);
        }

        return view('triaje.index');
    }
}
