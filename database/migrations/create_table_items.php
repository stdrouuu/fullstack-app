<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //Modify
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->text('description'); 
            $table->integer('price', 10, 2); 
            $table->unsignedBigInteger('category_id'); //relasi tabel items dengan tabel category
            $table->string('img')->nullable(); 
            $table->boolean('is_active')->default(true); //item aktif atau tidak
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
