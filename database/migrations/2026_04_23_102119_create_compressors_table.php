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
        Schema::create('compressors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_slug')->unique();

            $table->boolean('published')->default(true);
            $table->string('motor_power')->nullable();
            $table->string('fad')->nullable();
            $table->string('nominal_capacity')->nullable();
            $table->string('msf')->nullable();
            $table->string('capacities_iso')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compressors');
    }
};
