<?php

namespace App\Enums;

enum SeccionTiposEnum: string {

    case Simple     = 'simple';
    case Slider     = 'slider';
    case Tarjeta    = 'card';
    case Mixto      = 'mixto';
    case Mapa       = 'mapa';

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}