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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('criteria_id')->constrained('criterias')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('formation_id')->constrained('formations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('type_package',['essay','option']);
            $table->integer('duration');
            $table->float('max_score')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
