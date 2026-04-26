<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('compressor_id')->nullable();
            $table->decimal('capacity', 10, 1)->nullable();
            $table->integer('FAD')->nullable();
            $table->integer('CFM')->nullable();
            $table->integer('installed_power')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
