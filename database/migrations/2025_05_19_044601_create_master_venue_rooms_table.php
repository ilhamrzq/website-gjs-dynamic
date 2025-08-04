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
        Schema::create('master_venue_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venue_id')->nullable()->constrained('master_venues')->onDelete('set null');
            $table->foreignId('lang_id')->nullable()->constrained('master_languages')->onDelete('set null');
            $table->string('room_name');
            $table->string('room_description');
            $table->integer('room_minimum_charge');
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
        Schema::dropIfExists('master_venue_rooms');
    }
};
