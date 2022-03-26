<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo_admision extends Model
{
    use HasFactory;
    protected $table = "modulos_admision";
    

    protected $fillable = [
        'establecimiento_id',
        'nombre_modulo',
        'estado'
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class);
    }

}
