<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RucAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_ruc',
        'assistant_user_id',
    ];

    public function assistant(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'assistant_user_id'
        );
    }
}