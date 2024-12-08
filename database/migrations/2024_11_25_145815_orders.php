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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Pembeli
            $table->enum('status', ['pending', 'paid', 'shipped'])->default('pending');
            $table->decimal('total_price', 10, 2);
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->text('shipping_address'); // Alamat pembeli
            $table->enum('payment_method', ['bank_transfer', 'credit_card', 'cod']);
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
