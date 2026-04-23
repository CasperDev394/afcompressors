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
        DB::statement("create type user_types_list as enum ('ADMIN', 'SITE_USER')");
        DB::statement("alter table users add entity_type user_types_list");

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('entity_id')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
