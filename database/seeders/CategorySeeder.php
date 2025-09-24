<?php

//php artisan make:seeder CategorySeeder

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    //Modify
    public function run(): void
    {
        $categories = [
            ['cat_name' => 'Makanan', 'description' => 'Kategori makanan'],
            ['cat_name' => 'Minuman', 'description' => 'Kategori minuman'],
        ];

        DB::table('categories')->insert($categories);
    //----------------
    }
}
