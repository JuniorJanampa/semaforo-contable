<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Expedient\TrafficLight;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expedient extends Model
{
    use HasFactory;

    protected $fillable = [

        'company_id',

        'period_id',

        'assistant_user_id',

        'code',

        'traffic_light',

        'sales_completed_at',

        'purchases_completed_at',

        'tax_completed_at',

        'assistant_observation',

    ];

    protected function casts(): array
    {
        return [

            'traffic_light' => TrafficLight::class,

            'sales_completed_at' => 'datetime',

            'purchases_completed_at' => 'datetime',

            'tax_completed_at' => 'datetime',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    public function assistant(): BelongsTo
    {
        return $this->belongsTo(

            User::class,

            'assistant_user_id'

        );
    }

    public function answers(): HasMany
    {
        return $this->hasMany(

            ChecklistAnswer::class

        );
    }

    public function declarations(): HasMany
    {
        return $this->hasMany(

            ExpedientDeclaration::class

        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function currentDeclaration(): HasMany
    {
        return $this->declarations()

            ->latest('declared_at');
    }

    public function answeredQuestionsCount(): int
    {
        return $this->answers()->count();
    }

    public function totalQuestionsCount(): int
    {
        return ChecklistQuestion::query()

            ->where(

                'is_active',

                true

            )

            ->count();
    }

    public function progressPercentage(): int
    {
        $total = $this->totalQuestionsCount();

        if ($total === 0) {

            return 0;

        }

        return (int) round(

            ($this->answeredQuestionsCount() * 100) / $total

        );
    }

    public function isDeclared(): bool
    {
        return $this->declarations()->exists();
    }

    public function salesCompleted(): bool
    {
        return $this->sales_completed_at !== null;
    }

    public function purchasesCompleted(): bool
    {
        return $this->purchases_completed_at !== null;
    }

    public function taxCompleted(): bool
    {
        return $this->tax_completed_at !== null;
    }
}