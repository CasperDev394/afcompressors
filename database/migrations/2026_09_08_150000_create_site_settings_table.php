<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 50);
            $table->string('email');
            $table->string('home_h1');
            $table->string('home_title');
            $table->text('home_description')->nullable();
            $table->timestamps();
        });

        DB::table('site_settings')->insert([
            'phone' => '+7 999 999 99 99',
            'email' => 'afcompressors@email.com',
            'home_h1' => 'Energy Sobriety',
            'home_title' => 'AF compressors',
            'home_description' => 'AF compressors',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
