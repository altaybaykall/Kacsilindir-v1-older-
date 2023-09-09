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
        Schema::create('engines', function (Blueprint $table) {
            $table->foreignId('engine_id')->nullable()->constrained('cars','model_id')->cascadeOnDelete();
            $table->integer('engine_size')->nullable();
            $table->integer('cylinders')->nullable();
            $table->string('transmission');
            $table->integer('horse_power');
            $table->integer('torque');
            $table->float('hundred_sec');
            $table->string('fuel_type');
            $table->string('drivetrain');
            $table->float('top_speed');


            //$table->foreign("engine_id")->references("model_id")->on("cars");
            //$table->foreignId('engine_id')->constrained('cars');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engines');
    }
};
