<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Checklist\QuestionInputType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChecklistQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'checklist_id',
        'question',
        'input_type',
        'options',
        'order',
        'is_required',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'input_type' => QuestionInputType::class,
            'is_required' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function checklist(): BelongsTo
    {
        return $this->belongsTo(Checklist::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(
            ChecklistAnswer::class,
            'question_id'
        );
    }
}