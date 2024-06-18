<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Seccion extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'seccion';

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'imagen_telefono',
        'tipo',
        // 'color',
        'estado',
        'orden',
        'enlace',
        'mapa', //para maps
        'identificador',
        'banner_principal'
    ];

    // Relacion 1 a M (Una seccion tiene muchas subsecciones)
    public function subsecciones()
    {
        return $this->hasMany(SubSeccion::class);
    }

    // Para el enums
    protected $tipo = ['slider', 'tarjeta'];

    // Agregué esta función para poder utilizar LogActivity, sin esta funcion marca error
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                    ->logAll()
                    ->useLogName('Seccion')
                    ->setDescriptionForEvent(fn(string $eventName) => "Se ha {$eventName} la sección de inicio");
    }
}
