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
            $table->foreignId('participant_id')->constrained();
            $table->foreignId('criteria_id')->constrained();
            $table->float('score'); // Nilai asli (0-100)
            $table->float('score_fuzzy'); // Hasil konversi ke fuzzy (0, 0.25, 0.5, 0.75, 1)
            $table->float('score_fuzzy_normalized'); // Nilai ternormalisasi (fuzzy_value / max_per_criteria)
            $table->float('score_final'); // Nilai ternormalisasi (fuzzy_value / max_per_criteria)
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
