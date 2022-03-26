<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivos_adjunto extends Model
{
    use HasFactory;
    protected $table = "archivos_adjuntos";
    

    protected $fillable = [
        'usuariosatendido_id',
        'nombrearchivo',
    ];
}
