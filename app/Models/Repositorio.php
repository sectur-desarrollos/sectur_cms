<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Repositorio extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'titulo',
        'archivo',
        'tipo',
    ];

    // Agregué esta función para poder utilizar LogActivity, sin esta funcion marca error
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                    ->logAll()
                    ->useLogName('Repositorio')
                    ->setDescriptionForEvent(fn(string $eventName) => "Se ha {$eventName} el repositorio");
    }
}
