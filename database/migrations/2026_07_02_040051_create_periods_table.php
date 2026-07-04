<?php

declare(strict_types=1);

use App\Enums\Period\PeriodStatus;
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
        Schema::create('periods', function (Blueprint $table) {

            $table->id();

            $table->unsignedSmallInteger('year');

            $table->unsignedTinyInteger('month');

            $table->string('status')
                ->default(PeriodStatus::OPEN->value);

            $table->timestamp('opened_at')->nullable();

            $table->timestamp('closed_at')->nullable();

            $table->timestamps();

            $table->unique([
                'year',
                'month'
            ]);

            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};