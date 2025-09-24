<?php

// php artisan make:seeder ItemSeeder

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    //Modify
    public function run(): void
    {
        Item::factory(10)->create(); //panggil factory item dgn data 10
    }
}
