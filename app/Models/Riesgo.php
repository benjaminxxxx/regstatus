<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riesgo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'riesgo',
        'min',
        'max',
        'estado',
        'orden',
        'logo',
        'tiporiesgo'
    ];
}
