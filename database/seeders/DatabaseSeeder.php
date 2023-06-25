<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(UsersTableSeeder::class);
       $this->call(CurrenciesSeederTable::class);
       $this->call(SettingsTableSeeder::class);


        User::factory(20)->create();
        Category::factory(20)->create();
        Brand::factory(10)->create();
        Product::factory(100)->create();
    }
}