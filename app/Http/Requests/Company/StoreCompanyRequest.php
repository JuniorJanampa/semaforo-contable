<?php

declare(strict_types=1);

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'ruc' => [
                'required',
                'digits:11',
                'unique:companies,ruc',
            ],

            'business_name' => [
                'required',
                'string',
                'max:255',
            ],

            'trade_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tax_address' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

        ];
    }
}