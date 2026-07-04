<?php

declare(strict_types=1);

namespace App\Enums\User;

enum UserRole: string
{
    case ADMIN = 'ADMIN';

    case ASSISTANT = 'ASSISTANT';

    case ACCOUNTANT = 'ACCOUNTANT';

    public function label(): string
    {
        return match ($this) {

            self::ADMIN => 'Administrador',

            self::ASSISTANT => 'Asistente',

            self::ACCOUNTANT => 'Contador',

        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return collect(self::cases())

            ->mapWithKeys(fn (self $role) => [

                $role->value => $role->label(),

            ])

            ->toArray();
    }

    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }

    public function isAssistant(): bool
    {
        return $this === self::ASSISTANT;
    }

    public function isAccountant(): bool
    {
        return $this === self::ACCOUNTANT;
    }
}