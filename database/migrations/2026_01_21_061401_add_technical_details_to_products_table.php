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
            $table->string('model_code')->nullable()->after('slug');
            $table->decimal('prime_power_kw', 8, 2)->nullable()->after('prime_power_kva');
            $table->decimal('standby_power_kw', 8, 2)->nullable()->after('standby_power_kva');
            $table->json('technical_specifications')->nullable()->after('features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['model_code', 'prime_power_kw', 'standby_power_kw', 'technical_specifications']);
        });
    }
};
