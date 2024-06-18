<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PaginaSeccionSubseccionArchivo extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'paginas_secciones_subseccion_archivos';

    protected $fillable = [
        'titulo',
        'archivo',
        'tipo',
        'size_archivo',
        'enlace',
        'estado',
        'subseccion_id',
        'subseccion_slug',
        'seccion_slug',
        'pagina_slug',
    ];


    // Relación 1:M inversa (Varios archivos pertenecen a una subseccion)
    public function paginaSeccionSubseccion()
    {
        return $this->belongsTo(PaginaSeccionSubseccion::class, 'subseccion_id');
    }

    // Agregué esta función para poder utilizar LogActivity, sin esta funcion marca error
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                    ->logAll()
                    ->useLogName('Archivo Subsección')
                    ->setDescriptionForEvent(fn(string $eventName) => "Se ha {$eventName} archivos de la subsección la página");
    }
}
