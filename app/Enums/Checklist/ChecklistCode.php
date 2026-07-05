<?php

declare(strict_types=1);

namespace App\Enums\Checklist;

enum ChecklistCode: string
{
    case VENTAS = 'VENTAS';

    case COMPRAS = 'COMPRAS';

    case TRIBUTACION = 'TRIBUTACION';

    public function label(): string
    {
        return match ($this) {

            self::VENTAS => 'Ventas',

            self::COMPRAS => 'Compras',

            self::TRIBUTACION => 'Tributación',

        };
    }

    public static function values(): array
    {
        return array_column(

            self::cases(),

            'value'

        );
    }

    public static function options(): array
    {
        return collect(self::cases())

            ->mapWithKeys(

                fn (self $checklist) => [

                    $checklist->value => $checklist->label(),

                ]

            )

            ->toArray();
    }
}