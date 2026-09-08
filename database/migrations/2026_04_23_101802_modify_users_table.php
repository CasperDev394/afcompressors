<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::connection()->getDriverName() === 'pgsql') {
            DB::statement(<<<'SQL'
                DO $$
                BEGIN
                    CREATE TYPE user_types_list AS ENUM ('ADMIN', 'SITE_USER');
                EXCEPTION
                    WHEN duplicate_object THEN NULL;
                END
                $$
            SQL);
            DB::statement('alter table users add entity_type user_types_list');
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('entity_type', ['ADMIN', 'SITE_USER'])->nullable();
            });
        }

        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('entity_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['entity_type', 'entity_id']);
        });

        if (DB::connection()->getDriverName() === 'pgsql') {
            DB::statement('drop type if exists user_types_list');
        }
    }
};
