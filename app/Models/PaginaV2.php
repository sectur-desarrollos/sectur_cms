<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaginaV2 extends Model
{
    use HasFactory;

    protected $table = 'paginas_v2';

    protected $fillable = [
        'titulo', 'imagen_destacada', 'contenido', 'slug', 'seo_titulo', 'seo_descripcion', 'seo_keywords', 'fecha_actualizacion', 'fuente', 'activo'
    ];

    protected $casts = [
        'fecha_actualizacion' => 'datetime',
    ];
    
    public function archivos()
    {
        return $this->hasMany(ArchivoV2::class, 'pagina_id');
    }

    public function enlaces()
    {
        return $this->hasMany(EnlaceV2::class, 'pagina_id');
    }

    public function secciones()
    {
        return $this->hasMany(SeccionV2::class, 'pagina_id');
    }
    
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
