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
        Schema::create('master_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venue_id')->nullable()->constrained('master_venues')->onDelete('set null');
            $table->foreignId('lang_id')->nullable()->constrained('master_languages')->onDelete('set null');
            $table->string('event_title');
            $table->string('event_slug');
            $table->text('event_description');
            $table->text('event_content');
            $table->date('event_start_date');
            $table->date('event_end_date');
            $table->enum('event_status', ['COMING_SOON', 'NEWS']);
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
        Schema::dropIfExists('master_events');
    }
};
