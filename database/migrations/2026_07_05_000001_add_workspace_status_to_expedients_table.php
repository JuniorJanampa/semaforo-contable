<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expedients', function (Blueprint $table) {

            $table->timestamp('sales_completed_at')
                ->nullable()
                ->after('traffic_light');

            $table->timestamp('purchases_completed_at')
                ->nullable()
                ->after('sales_completed_at');

            $table->timestamp('tax_completed_at')
                ->nullable()
                ->after('purchases_completed_at');

            $table->text('assistant_observation')
                ->nullable()
                ->after('tax_completed_at');

        });
    }

    public function down(): void
    {
        Schema::table('expedients', function (Blueprint $table) {

            $table->dropColumn([

                'sales_completed_at',

                'purchases_completed_at',

                'tax_completed_at',

                'assistant_observation',

            ]);

        });
    }
};