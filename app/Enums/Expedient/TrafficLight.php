<?php

declare(strict_types=1);

namespace App\Enums\Expedient;

enum TrafficLight: string
{
    case RED = 'RED';
    case YELLOW = 'YELLOW';
    case AMBER = 'AMBER';
    case BLUE = 'BLUE';
    case GREEN = 'GREEN';

    public function label(): string
    {
        return match ($this) {
            self::RED => 'Sin revisar',
            self::YELLOW => 'Ventas revisadas',
            self::AMBER => 'Compras revisadas',
            self::BLUE => 'Listo para declarar',
            self::GREEN => 'Declarado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::RED => 'danger',
            self::YELLOW => 'warning',
            self::AMBER => 'orange',
            self::BLUE => 'info',
            self::GREEN => 'success',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::RED => 'badge-red',
            self::YELLOW => 'badge-yellow',
            self::AMBER => 'badge-amber',
            self::BLUE => 'badge-blue',
            self::GREEN => 'badge-green',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}