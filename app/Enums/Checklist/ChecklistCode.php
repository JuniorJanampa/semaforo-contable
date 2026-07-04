<?php

declare(strict_types=1);

namespace App\Enums\Checklist;

enum ChecklistCode: string
{
    case SALES = 'SALES';
    case PURCHASES = 'PURCHASES';
    case TAX = 'TAX';

    public function label(): string
    {
        return match ($this) {
            self::SALES => 'Ventas',
            self::PURCHASES => 'Compras',
            self::TAX => 'Tributario',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $checklist) => [
                $checklist->value => $checklist->label(),
            ])
            ->toArray();
    }
}