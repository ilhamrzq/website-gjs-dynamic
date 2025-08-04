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
        Schema::create('cms_homepage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lang_id')->nullable()->constrained('master_languages')->onDelete('set null');
            $table->string('hero_title');
            $table->text('hero_description');
            $table->string('feature_left_title');
            $table->text('feature_left_description');
            $table->string('feature_center_title');
            $table->text('feature_center_description');
            $table->string('feature_right_title');
            $table->text('feature_right_description');
            $table->string('video_path')->nullable();
            $table->string('video_name')->nullable();
            $table->string('video_size')->nullable();
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
        Schema::dropIfExists('cms_homepage');
    }
};
