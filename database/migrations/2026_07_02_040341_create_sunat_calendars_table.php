<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sunat_calendars', function (Blueprint $table) {

            $table->id();

            $table->unsignedSmallInteger('year');

            $table->unsignedTinyInteger('month');

            $table->unsignedTinyInteger('last_ruc');

            $table->date('due_date');

            $table->timestamps();

            $table->unique([
                'year',
                'month',
                'last_ruc'
            ]);

            $table->index('due_date');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunat_calendars');
    }
};