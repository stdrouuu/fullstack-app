<?php

// php artisan make:seeder UserSeeder

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    //Modify
    public function run(): void
    {
        User::factory(10)->create(); //panggil model dan factory user dan generate 10 data
    }
    //----------------
}
