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
        Schema::create('economy', function (Blueprint $table) {
            $table->foreignId('economy_id')->nullable()->constrained('cars','model_id')->cascadeOnDelete();
            $table->float('fuel_cons_avg');
            $table->float('fuel_cons_ic')->nullable();
            $table->float('fuel_cons_oc')->nullable();
            $table->integer('fuel_tank');
            $table->integer('range');
            $table->integer('emission');


            //$table->foreign("economy_id")->references("model_id")->on("cars");
           // $table->foreignId('economy_id')->constrained('cars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('economy');
    }
};
