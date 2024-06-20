<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeccionV2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'pagina_id', 'titulo', 'slug', 'ordenamiento', 'activo'
    ];

    protected $table = 'secciones_v2';

    public function subsecciones()
    {
        return $this->hasMany(SubseccionV2::class, 'seccion_id');
    }

    public function archivos()
    {
        return $this->hasMany(ArchivoV2::class,'seccion_id');
    }

    public function enlaces()
    {
        return $this->hasMany(EnlaceV2::class,'seccion_id');
    }

    public function pagina()
    {
        return $this->belongsTo(PaginaV2::class, 'pagina_id');
    }
}
