<?php

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
        Schema::create('fuzzy_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_type')->comment('1=exam, 2=evaluation'); // Tambahkan field ini
            $table->foreignId('source_id')->comment('ID dari exam/evaluation');
            $table->foreignId('participant_id')->constrained('participants')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('criteria_id')->constrained('criterias')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('formation_id')->constrained('formations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('score'); // Nilai asli (0-100)
            $table->float('score_fuzzy'); // Hasil konversi ke fuzzy (0, 0.25, 0.5, 0.75, 1)
            $table->float('score_fuzzy_normalized')->nullable(); // Nilai ternormalisasi (fuzzy_value / max_per_criteria)
            $table->float('score_final')->nullable(); // Nilai ternormalisasi (fuzzy_value / max_per_criteria)
            $table->timestamps();

            $index = $table->unique(['source_type', 'source_id', 'participant_id', 'criteria_id'], 'unique_fuzzy_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzy_scores');
    }
};
