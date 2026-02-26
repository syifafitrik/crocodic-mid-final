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
        Schema::create('data_payment', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('voucher_id');
            $table->decimal('voucher_value', 38, 3)->default(0);
            $table->integer('payment_id');
            $table->decimal('payment_amount', 38, 3)->default(0);
            $table->integer('user_id');
            $table->integer('status')->default(0); // 0 = WAITING | 1 = COMPLETED | 2 = CANCEL 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_payment');
    }
};
