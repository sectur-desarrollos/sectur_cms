<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PaginaSeccionArchivo extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'paginas_secciones_archivos';

    protected $fillable = [
        'titulo',
        'archivo',
        'tipo',
        'size_archivo',
        'enlace',
        'estado',
        'seccion_id',
        'seccion_slug',
        'pagina_slug',
    ];

    // Relación 1:M inversa (Varios archivos pertenecen a una seccion)
    public function paginaSeccion()
    {
        return $this->belongsTo(PaginaSeccion::class, 'seccion_id');
    }

    // Agregué esta función para poder utilizar LogActivity, sin esta funcion marca error
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                    ->logAll()
                    ->useLogName('Archivos Sección')
                    ->setDescriptionForEvent(fn(string $eventName) => "Se ha {$eventName} archivos de la sección de la página");
    }
}
