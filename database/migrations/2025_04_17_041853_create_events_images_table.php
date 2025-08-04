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
        Schema::create('events_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->nullable()->constrained('master_events')->onDelete('set null');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_size');
            $table->integer('is_default');
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
            $table->integer('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_images');
    }
};
