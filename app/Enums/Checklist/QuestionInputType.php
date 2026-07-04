<?php

declare(strict_types=1);

namespace App\Enums\Checklist;

enum QuestionInputType: string
{
    case BOOLEAN = 'boolean';
    case TEXT = 'text';
    case TEXTAREA = 'textarea';
    case NUMBER = 'number';
    case DATE = 'date';
    case SELECT = 'select';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $type) => [
                $type->value => ucfirst($type->value),
            ])
            ->toArray();
    }
}