<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpedientDeclaration extends Model
{
    use HasFactory;

    protected $fillable = [
        'expedient_id',
        'accountant_user_id',
        'declared_at',
        'observation',
        'is_current',
    ];

    protected function casts(): array
    {
        return [
            'declared_at' => 'datetime',
            'is_current' => 'boolean',
        ];
    }

    public function expedient(): BelongsTo
    {
        return $this->belongsTo(Expedient::class);
    }

    public function accountant(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'accountant_user_id'
        );
    }
}