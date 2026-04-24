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
        Schema::create('attachmentable', function (Blueprint $table) {
            $table->id();
            $table->string('attachmentable_type');
            $table->unsignedBigInteger('attachmentable_id');
            $table->integer('attachment_id')->unsigned()->nullable(false);
            $table->string('entity', 64)->nullable();
            $table->foreign('attachment_id')->references('id')->on('attachments');
            $table->index(['attachmentable_id', 'attachmentable_type'], 'attachmentable_id_and_type_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachmentable');
    }
};
