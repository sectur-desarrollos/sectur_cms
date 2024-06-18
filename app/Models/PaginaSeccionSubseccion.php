<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PaginaSeccionSubseccion extends Model
{
    use HasFactory, LogsActivity;
    
    // Se asigna a que migración/tabla va a apuntar este modelo
    protected $table = 'paginas_secciones_subseccion';

    // Se declara la asignación masiva
    protected $fillable = [
        'titulo',
        'slug',
        'estado',
        'seccion_id',
        'seccion_slug',
        'pagina_slug',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }
    
    // Relación 1:M. Una subsección tiene muchos archivos
    public function paginasSeccionesSubseccionesArchivos()
    {
        return $this->hasMany(PaginaSeccionSubseccionArchivo::class, 'subseccion_id');
    }

    // Relación 1:M (inversa) Varias secciones pertenecen a una sección
    public function paginaSeccion() 
    {
        return $this->belongsTo(PaginaSeccion::class, 'seccion_id');
    }

    // Agregué esta función para poder utilizar LogActivity, sin esta funcion marca error
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                    ->logAll()
                    ->useLogName('Subsección Página')
                    ->setDescriptionForEvent(fn(string $eventName) => "Se ha {$eventName} la subsección de la página");
    }
}
