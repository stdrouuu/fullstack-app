<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // RoleSeeder::class, //seeder role
            // CategorySeeder::class, //seeder category
            ItemSeeder::class, //factory item
            // UserSeeder::class, //factory user
        ]);
    }
    // php artisan db:seed => push img to database, generate random data from seeder
}
