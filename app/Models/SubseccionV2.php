<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubseccionV2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'seccion_id', 'titulo', 'slug', 'ordenamiento', 'activo'
    ];

    protected $table = 'subsecciones_v2';

    public function archivos()
    {
        return $this->hasMany(ArchivoV2::class, 'subseccion_id');
    }

    public function enlaces()
    {
        return $this->hasMany(EnlaceV2::class, 'subseccion_id');
    }

    public function seccion()
    {
        return $this->belongsTo(SeccionV2::class, 'seccion_id');
    }
}
