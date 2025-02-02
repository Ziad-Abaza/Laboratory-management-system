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
        Schema::create('order_has_lab_tests', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('lab_tests_id')->constrained('lab_tests');
            $table->string('result')->nullable();
            $table->date('result_date')->nullable();
            $table->primary(['order_id', 'lab_tests_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_has_lab_tests');
    }
};
