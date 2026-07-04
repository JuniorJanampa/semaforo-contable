<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChecklistAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'expedient_id',
        'question_id',
        'value',
        'comment',
        'answered_by_user_id',
    ];

    public function expedient(): BelongsTo
    {
        return $this->belongsTo(Expedient::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(
            ChecklistQuestion::class,
            'question_id'
        );
    }

    public function answeredBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'answered_by_user_id'
        );
    }
}