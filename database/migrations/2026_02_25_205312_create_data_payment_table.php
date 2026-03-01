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
            $table->string('tanggal', 100);
            $table->integer('voucher_id');
            $table->decimal('voucher_value', 38, 2)->default(0);
            $table->string('voucher_code');
            $table->integer('payment_id');
            $table->decimal('payment_amount', 38, 2)->default(0);
            $table->string('payment_link')->nullable();
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
