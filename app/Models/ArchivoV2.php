<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoV2 extends Model
{
    use HasFactory;

    protected $table = 'archivos_v2';

        // Clave primaria de la tabla
        protected $primaryKey = 'id';

    protected $fillable = [
        'pagina_id', 'seccion_id', 'subseccion_id', 'nombre', 'path', 'tipo', 'tamaño', 'ordenamiento', 'activo'
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
