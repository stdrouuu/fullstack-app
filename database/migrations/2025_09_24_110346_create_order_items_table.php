<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); //relasi tabel order_items dengan tabel orders
            $table->unsignedBigInteger('item_id'); //relasi tabel order_items dengan tabel items
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('tax');
            $table->integer('total_price'); 
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('item_id')->references('id')->on('items');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
