<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Menu extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'slug',
        'parent',
        'order',
        'enabled',
        'enlace',
        'target',
        'pagina_id',
        'nombre_pagina',
        'menu_id',
    ];

    // Menu dinámico (multinivel)
    public function getChildren($data, $line)
    {
        $children = [];
        foreach ($data as $line1) {
            if ($line['id'] == $line1['parent']) {
                $children = array_merge($children, [ array_merge($line1, ['submenu' => $this->getChildren($data, $line1) ]) ]);
            }
        }
        return $children;
    }
    public function optionsMenu()
    {
        return $this->where('enabled', 1)
            ->orderby('parent')
            ->orderby('order')
            ->orderby('name')
            ->get()
            ->toArray();
    }
    public static function menus()
    {
        $menus = new Menu();
        $data = $menus->optionsMenu();
        $menuAll = [];
        foreach ($data as $line) {
            $item = [ array_merge($line, ['submenu' => $menus->getChildren($data, $line) ]) ];
            $menuAll = array_merge($menuAll, $item);
        }
        return $menus->menuAll = $menuAll;
    }
    // Menú dinámico (multinivel)

    // Relación de un menú tiene muchas páginas 1:M
    public function paginas()
    {
        return $this->hasMany(Pagina::class);
    }

    // Relación recursiva de menús, un menu tiene varios menus
    public function menuss()
    {
        return $this->hasMany(Menu::class);
    }

    // Relación recursiva menus, se obtienen los hijos
    public function children_menus()
    {
        return $this->hasMany(Menu::class)->with('menuss');
    }
    
    // Relación recursiva menus, 1:M (inversa) se obtienen los padres
    public function parent()
    {
        // Recusrividad que devuelve todos los padres
        // La función with() se llama de forma recursiva
        //Si se remueve el wiith, unicamente muestra al padre directo
        return $this->belongsTo(Menu::class, 'menu_id')->with('parent');
    }

    // Agregué esta función para poder utilizar LogActivity
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                    ->logAll()
                    ->useLogName('Menú')
                    ->setDescriptionForEvent(fn(string $eventName) => "Se ha {$eventName} el menú");
    }
}
