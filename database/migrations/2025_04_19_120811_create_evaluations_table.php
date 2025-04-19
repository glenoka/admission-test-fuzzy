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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessors_id')->constrained('assessors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('formation_selection_id')->constrained('formation_selections')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date'); // Tanggal penilaian
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
