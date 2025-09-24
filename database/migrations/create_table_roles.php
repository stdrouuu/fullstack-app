<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        //Modify
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name')->unique();
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('roles')->insert($roles);
        //----------------
    }


    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
