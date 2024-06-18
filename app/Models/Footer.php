<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Footer extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nombre',
        'valor',
        'tipo',
        'enlace',
        'estado',
    ];

    // Agregué esta función para poder utilizar LogActivity, sin esta funcion marca error
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                    ->logAll()
                    ->useLogName('Footer')
                    ->setDescriptionForEvent(fn(string $eventName) => "Se ha {$eventName} el footer");
    }
}
