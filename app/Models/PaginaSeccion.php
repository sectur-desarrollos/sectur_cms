<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PaginaSeccion extends Model
{
    use HasFactory, LogsActivity;

    // Se asigna a que migración/tabla va a apuntar este modelo
    protected $table = 'paginas_secciones';

    // Se declara la asignación masiva
    protected $fillable = [
        'titulo',
        'slug',
        'estado',
        'pagina_id',
        'pagina_slug',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    // Relación 1:M inversa (Una sección pertenece a una página)
    public function pagina()
    {
        return $this->belongsTo(Pagina::class);
    }

    // Relación 1:M. Una sección tiene muchos archivos
    public function paginasSeccionesArchivos()
    {
        return $this->hasMany(PaginaSeccionArchivo::class,'seccion_id');
    }

        // Relación 1:M. Una sección tiene muchas subsecciones
        public function paginasSeccionesSubsecciones()
        {
            return $this->hasMany(PaginaSeccionSubseccion::class,'seccion_id');
        }

    // Agregué esta función para poder utilizar LogActivity, sin esta funcion marca error
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                    ->logAll()
                    ->useLogName('Seccion Página')
                    ->setDescriptionForEvent(fn(string $eventName) => "Se ha {$eventName} la sección de la página");
    }
}
