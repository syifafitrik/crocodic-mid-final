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
        Schema::create('master_voucher', function (Blueprint $table) {
            $table->id();
            $table->integer('game_id');
            $table->string('voucher_title', 200);
            $table->decimal('voucher_value', 38, 2)->default(0);
            $table->decimal('voucher_price', 38, 2)->default(0);
            $table->integer('user_id');
            $table->integer('is_hot', 1)->default(0);
            $table->integer('is_active')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_voucher');
    }
};
