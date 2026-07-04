<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [

            [
                'ruc' => '20100000001',
                'business_name' => 'Empresa Demo SAC',
                'trade_name' => 'Empresa Demo',
                'tax_address' => 'Lima',
                'email' => 'empresa1@demo.pe',
                'phone' => '999999991',
            ],

            [
                'ruc' => '20100000002',
                'business_name' => 'Servicios Integrales SAC',
                'trade_name' => 'Servicios',
                'tax_address' => 'Lima',
                'email' => 'empresa2@demo.pe',
                'phone' => '999999992',
            ],

            [
                'ruc' => '20100000003',
                'business_name' => 'Importadora Perú SAC',
                'trade_name' => 'Importadora Perú',
                'tax_address' => 'Lima',
                'email' => 'empresa3@demo.pe',
                'phone' => '999999993',
            ],

        ];

        foreach ($companies as $company) {

            Company::updateOrCreate(

                ['ruc' => $company['ruc']],

                $company

            );

        }
    }
}