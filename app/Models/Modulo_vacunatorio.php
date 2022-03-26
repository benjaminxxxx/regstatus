<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo_vacunatorio extends Model
{
    use HasFactory;
    protected $table = "modulos_vacunatorio";

    protected $fillable = [
        'establecimiento_id',
        'nombre_vacunatorio',
        'estado'
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }
    
}
