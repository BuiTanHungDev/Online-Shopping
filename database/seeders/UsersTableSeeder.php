<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->insert([

      //customer
      [
        'full_name' => 'le Van Customer',
        'username' => 'Customer',
        'email' => 'customer@gmail.com',
        'password' => Hash::make('1111'),
        'status' => 'active',

      ],
    ]);

    DB::table('admins')->insert([

      //customer
      [
        'full_name' => 'Bui Tan Hung - Admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('1111'),
        'status' => 'active',

      ],
    ]);
    DB::table('sellers')->insert([

      //Seller
      [
        'full_name' => 'Mr. Seller',
        'username' => 'Mr. Seller',
        'email' => 'seller@gmail.com',
        'password' => Hash::make('11111'),
        'address' => 'Quang Ngai City',
        'phone' => '012345678',
        'photo' => '',
        'is_verified'=>1,
        'status' => 'active',

      ],
    ]);
  }
}
