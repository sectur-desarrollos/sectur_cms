<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialLog extends Model
{
    // Nombre de la tabla asociada
    protected $table = 'historial_logs';

    // Clave primaria de la tabla
    protected $primaryKey = 'id';
  
    // Atributos asignables en masa
    protected $fillable = [
        'usuario_id', 'usuario_nombre', 'modulo', 'accion', 'lugar', 'informacion', 'fecha_accion'
    ];
  
    // Atributos que no son asignables en masa
    protected $guarded = [];
    
    // Indica si el modelo tiene marcas de tiempo
    public $timestamps = false;
  
    // Define los tipos de los atributos
    protected $casts = [
        'usuario_id' => 'integer',
        'fecha_accion' => 'datetime',
    ];
}
