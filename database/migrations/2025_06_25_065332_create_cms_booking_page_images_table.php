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
        Schema::create('cms_booking_page_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_page_id')
                ->nullable()
                ->constrained('cms_booking_page')
                ->onDelete('set null');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_size');
            $table->boolean('is_default')->default(false);
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
        Schema::dropIfExists('cms_booking_page_images');
    }
};
