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
        
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained('participants')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignid('package_id')->constrained('packages')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('duration');
            $table->string('slug'); //kode dari exam
            $table->integer('total_score')->nullable();
            $table->foreignId('assessor_id')->constrained('assessors')->onDelete('cascade')->nullable();
            $table->timestamp('started_at');
            $table->timestamp('finish_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
