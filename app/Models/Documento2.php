<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento2 extends Model
{
    use HasFactory;
    protected $table = 'documentos2';
    protected $fillable = [
        'usuariosatendido_id',
        'documento_nombre_1',
        'documento_nombre_2',
        'documento_nombre_3'
    ];

    public function usuarioatendido(){
        return $this->belongsTo(Pacientes2::class, 'usuariosatendido_id', 'id');
    }
   
}
