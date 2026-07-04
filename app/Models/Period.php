<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Period\PeriodStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'month',
        'status',
        'opened_at',
        'closed_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => PeriodStatus::class,
            'opened_at' => 'datetime',
            'closed_at' => 'datetime',
        ];
    }

    public function expedients(): HasMany
    {
        return $this->hasMany(Expedient::class);
    }

    public function getNameAttribute(): string
    {
        return sprintf('%02d/%04d', $this->month, $this->year);
    }
}