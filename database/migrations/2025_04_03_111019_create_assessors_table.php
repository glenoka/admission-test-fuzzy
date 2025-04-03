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
        Schema::create('assessors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female']);
            $table->string('religion');
            $table->foreignId('village_id')->constrained('villages')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('telp');
            $table->string('email');
            $table->text('address');
            $table->string('image');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('status', ['active', 'inactive']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessors');
    }
};
