<?php

declare(strict_types=1);

namespace App\Http\Requests\Period;

use Illuminate\Foundation\Http\FormRequest;

class StorePeriodRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'year' => [
                'required',
                'integer',
                'digits:4',
                'min:2024',
            ],

            'month' => [
                'required',
                'integer',
                'between:1,12',
            ],

        ];
    }
}