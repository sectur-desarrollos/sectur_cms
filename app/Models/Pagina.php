<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Pagina extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'titulo',
        'slug',
        'imagen_destacada',
        'contenido',
        'tipo_pagina',
        'estado',
        'imagen_principal_estado',
        'fuente',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // Relacion para ckeditor y las imagenes
    public function images()
    {
        return $this->hasMany(ImagesCkeditor::class);
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }

    // Relación 1:M. Una Página tiene muchas secciones
    public function paginasSecciones()
    {
        return $this->hasMany(PaginaSeccion::class);
    }

    // Agregué esta función para poder utilizar LogActivity, sin esta funcion marca error
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                    ->logAll()
                    ->useLogName('Página')
                    ->setDescriptionForEvent(fn(string $eventName) => "Se ha {$eventName} la página");
    }
}
