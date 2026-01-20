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
        Schema::table('products', function (Blueprint $table) {
            // Foreign Keys
            $table->foreignId('engine_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('alternator_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('controller_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('generator_type_id')->nullable()->constrained()->nullOnDelete();

            // Specifications
            $table->decimal('prime_power_kva', 10, 2)->nullable();
            $table->decimal('standby_power_kva', 10, 2)->nullable();
            $table->decimal('fuel_consumption_100_percent', 10, 2)->nullable();
            $table->decimal('fuel_tank_capacity', 10, 2)->nullable();
            $table->integer('length_mm')->nullable();
            $table->integer('width_mm')->nullable();
            $table->integer('height_mm')->nullable();
            $table->integer('weight_kg')->nullable();
            $table->integer('noise_level_db')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
