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
        Schema::create('reference_ranges', function (Blueprint $table) {
            $table->id();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->integer('age_min')->nullable();
            $table->integer('age_max')->nullable();
            $table->integer('min_value')->nullable();
            $table->integer('max_value')->nullable();
            $table->foreignId('lab_tests_id')->constrained('lab_tests');
            $table->timestamps();

            $table->index('lab_tests_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reference_ranges');
    }
};
