<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    use HasFactory;
    protected $fillable = [
        'rede_id',
        'nombre',
        'tiempoespera',
        'estado'
    ];
    public function rede(){
        return $this->belongsTo(Rede::class);
    }
}
