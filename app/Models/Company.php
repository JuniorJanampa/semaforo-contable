<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ruc',
        'business_name',
        'trade_name',
        'tax_address',
        'email',
        'phone',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function expedients(): HasMany
    {
        return $this->hasMany(Expedient::class);
    }

    public function getLastRucDigitAttribute(): int
    {
        return (int) substr($this->ruc, -1);
    }
}