<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //Modify
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->unsignedBigInteger('user_id'); //relasi tabel orders dengan tabel users 
            $table->integer('subtotal');
            $table->integer('tax');
            $table->integer('grandtotal');
            $table->enum('status', ['pending', 'settlement', 'cooked']);
            $table->integer('table_number');
            $table->enum('payment method', ['tunai', 'qris']);
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        //----------------
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
