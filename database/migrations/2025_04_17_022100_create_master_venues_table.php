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
        Schema::create('master_venues', function (Blueprint $table) {
            $table->id();
            $table->string('venue_name');
            $table->string('venue_address');
            $table->integer('venue_price');
            $table->string('venue_url');
            $table->string('venue_slug');
            $table->time('venue_opening_time');
            $table->time('venue_closing_time');
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
        Schema::dropIfExists('master_venues');
    }
};
