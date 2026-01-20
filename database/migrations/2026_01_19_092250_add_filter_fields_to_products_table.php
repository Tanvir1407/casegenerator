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
            $table->string('voltage')->nullable();
            $table->string('frequency')->nullable();
            $table->string('fuel')->nullable();
            $table->string('emissions_rating')->nullable();
            $table->string('engine_brand')->nullable();
            $table->string('engine_model')->nullable();
            $table->string('power_prp')->nullable();
            $table->string('power_esp')->nullable();
            $table->string('phases')->nullable();
            $table->string('version')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'voltage',
                'frequency',
                'fuel',
                'emissions_rating',
                'engine_brand',
                'engine_model',
                'power_prp',
                'power_esp',
                'phases',
                'version'
            ]);
        });
    }
};
