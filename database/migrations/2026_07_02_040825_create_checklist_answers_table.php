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
        Schema::create('checklist_answers', function (Blueprint $table) {

            $table->id();

            $table->foreignId('expedient_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('question_id')
                ->constrained('checklist_questions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->text('value')->nullable();

            $table->text('comment')->nullable();

            $table->foreignId('answered_by_user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->timestamps();

            $table->unique([
                'expedient_id',
                'question_id'
            ]);

            $table->index('answered_by_user_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_answers');
    }
};