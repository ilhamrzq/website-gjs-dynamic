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
        Schema::create('rel_product_discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('master_products')->onDelete('set null');
            $table->foreignId('discount_type_id')->nullable()->constrained('master_product_discount_types')->onDelete('set null');
            $table->integer('discount');
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
        Schema::dropIfExists('rel_product_discounts');
    }
};
