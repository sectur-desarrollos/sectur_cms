<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SubSeccion extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'sub_seccion';

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'enlace',
        'estado',
        'imagen_telefono', //Agregué esto para version de mobile
        'seccion_id',
    ];

    // Relación 1 a M (inversa), una subsección pertenece a una sección
    public function seccion()
    {
        return $this->belongsTo(Seccion::class);
    }

    // Agregué esta función para poder utilizar LogActivity, sin esta funcion marca error
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                    ->logAll()
                    ->useLogName('SubSeccion')
                    ->setDescriptionForEvent(fn(string $eventName) => "Se ha {$eventName} la subsección de inicio");
    }
}
