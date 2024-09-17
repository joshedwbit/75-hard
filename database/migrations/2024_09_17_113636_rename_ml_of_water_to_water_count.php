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
        Schema::table('personal_logs', function (Blueprint $table) {
            $table->renameColumn('ml_of_water', 'water_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_logs', function (Blueprint $table) {
            $table->renameColumn('water_count', 'ml_of_water');
        });
    }
};
