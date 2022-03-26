<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioAtendido extends Model
{
    use HasFactory;

    protected $table = "usuariosatendidos";

    protected $fillable = [
        'establecimiento_id',
        'modulo_admision',
        'modulo_vacunatorio',
        'nombres',
        'fecha_nacimiento',
        'edad',
        'licenciado',
        'vacunador_id',
        'zona',
        'modulo',
        'estado',
        'fechahora',
        'horaregistro',
        'horatriaje',
        'horaalta',
        'admision_dni',
        'admision_nombre',
        'digitador_dni',
        'digitador',
        'lector_dni',
        'lector',
        'marca',
        'lote',
        'dosis',
        'grupoderiesgo',
        'observacion',
        'consentimiento',
        'telefono',
        'domicilio',
        'apto',
        'triaje',
        'triaje_dni',
        'tipodocumento',
        'documento',
    ];

    public function archivos_adjuntos(){
        return $this->hasMany(Archivos_adjunto::class,'usuariosatendido_id');
    }
    public function companions(){
        return $this->hasMany(Companion::class,'usuariosatendido_id');
    }
    public function documentos(){
        return $this->hasMany(Documento::class,'usuariosatendido_id');
    }
}
