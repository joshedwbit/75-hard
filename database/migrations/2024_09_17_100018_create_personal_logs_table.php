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
        Schema::create('personal_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->integer('workouts')->default(0);
            $table->longText('workout_notes')->nullable();
            $table->integer('ml_of_water')->default(0);
            $table->longText('cheat_meals')->nullable();
            $table->integer('pages_read')->default(0);
            $table->longText('general_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_logs');
    }
};
