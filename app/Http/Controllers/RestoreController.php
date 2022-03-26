<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RestoreController extends Controller
{
    //
    public function index(Request $request){

        $mydir = public_path('docs'); 
  
        $myfiles = array_diff(scandir($mydir), array('.', '..')); 
        
        foreach ($myfiles as $file) {
            $nombre_archivo = public_path('docs/' . $file);
            if (file_exists($nombre_archivo)) {
                echo $file . ":" . date ("F d Y H:i:s.", filemtime($nombre_archivo)) . "<br>";
            }else{
                echo "No existe: " . $file . "<br>";
            }
        }

    }

}
