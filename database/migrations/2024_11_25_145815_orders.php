<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade'); // Penjual
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade'); // Pembeli
            $table->enum('status', ['pending', 'paid', 'shipped'])->default('pending');
            $table->decimal('shipping_cost', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->text('shipping_address');
            $table->enum('payment_method', ['bank_transfer', 'credit_card', 'cash_on_delivery']);
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->enum('shipping_status', ['dipacking', 'dikirim', 'diterima', 'batal'])->default('dipacking');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
