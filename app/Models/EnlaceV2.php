<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnlaceV2 extends Model
{
    use HasFactory;

    protected $table = 'enlaces_v2';

    protected $fillable = [
        'pagina_id', 'seccion_id', 'subseccion_id', 'nombre', 'url', 'ordenamiento', 'activo'
    ];

    public function pagina()
    {
        return $this->belongsTo(PaginaV2::class, 'pagina_id');
    }

    public function seccion()
    {
        return $this->belongsTo(SeccionV2::class,'seccion_id');
    }

    public function subseccion()
    {
        return $this->belongsTo(SubseccionV2::class, 'subseccion_id');
    }
}
