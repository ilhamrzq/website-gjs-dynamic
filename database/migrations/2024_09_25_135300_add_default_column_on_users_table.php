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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('created_by')->after('updated_at')->nullable();
            $table->integer('updated_by')->after('created_by')->nullable();
            $table->softDeletes()->after('updated_by');
            $table->integer('deleted_by')->after('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['deleted_by', 'deleted_at', 'updated_by', 'created_by']);
        });
    }
};
