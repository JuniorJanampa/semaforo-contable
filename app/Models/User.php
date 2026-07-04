<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\User\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [

        'name',

        'email',

        'password',

        'role',

    ];

    protected $hidden = [

        'password',

        'remember_token',

    ];

    protected function casts(): array
    {
        return [

            'email_verified_at' => 'datetime',

            'password' => 'hashed',

            'role' => UserRole::class,

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function expedients(): HasMany
    {
        return $this->hasMany(

            Expedient::class,

            'assistant_user_id'

        );
    }

    public function declarations(): HasMany
    {
        return $this->hasMany(

            ExpedientDeclaration::class,

            'accountant_user_id'

        );
    }

    public function checklistAnswers(): HasMany
    {
        return $this->hasMany(

            ChecklistAnswer::class,

            'answered_by_user_id'

        );
    }

    public function rucAssignments(): HasMany
    {
        return $this->hasMany(

            RucAssignment::class,

            'assistant_user_id'

        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isAdmin(): bool
    {
        return $this->role->isAdmin();
    }

    public function isAssistant(): bool
    {
        return $this->role->isAssistant();
    }

    public function isAccountant(): bool
    {
        return $this->role->isAccountant();
    }
}