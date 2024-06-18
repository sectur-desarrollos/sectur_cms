<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Archivo extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'titulo',
        'imagen',
        'documento',
        'descripcion',
        'size_documento',
        'type_documento',
        'size_imagen',
        'type_imagen',
        'enlace',
        'estado',
        'pagina_id',
    ];

    public function pagina()
    {
        return $this->belongsTo(Pagina::class);
    }

    // Agregué esta función para poder utilizar LogActivity, sin esta funcion marca error
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                    ->logAll()
                    ->useLogName('Archivo')
                    ->setDescriptionForEvent(fn(string $eventName) => "Se ha {$eventName} el archivo");
    }
}
