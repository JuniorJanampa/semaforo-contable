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
        Schema::create('checklist_questions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('checklist_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('question');

            $table->string('input_type', 20);

            $table->json('options')->nullable();

            $table->unsignedSmallInteger('order');

            $table->boolean('is_required')->default(true);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index([
                'checklist_id',
                'order'
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_questions');
    }
};