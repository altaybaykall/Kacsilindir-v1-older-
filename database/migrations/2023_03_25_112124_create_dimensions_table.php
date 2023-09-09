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
        Schema::create('dimensions', function (Blueprint $table) {
            $table->foreignId('dimension_id')->nullable()->constrained('cars','model_id')->cascadeOnDelete();
            $table->float('width');
            $table->float('height');
            $table->float('lenght');
            $table->float('weight');
            $table->string('body_type');
            $table->integer('door_num');
            $table->integer('seat_num');
            $table->integer('trunk_cap');

           //$table->foreign('dimension_id')->references('cars')->on('model_id');
           //$table->foreignId('dimension_id')->constrained('cars');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dimensions');
    }
};
