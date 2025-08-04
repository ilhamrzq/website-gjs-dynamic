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
        Schema::create('payments_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_order_id')->nullable()->constrained('users_orders')->onDelete('set null');
            $table->integer('payment_amount')->default(0);
            $table->enum('payment_status', ['PENDING', 'SUCCESS', 'FAILED'])->default('PENDING');
            $table->string('payment_method')->default('CASH');
            $table->dateTime('payment_expired_at');
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
        Schema::dropIfExists('payments_orders');
    }
};
