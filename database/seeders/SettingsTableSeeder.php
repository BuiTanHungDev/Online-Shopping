<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                'title'=>'H-Shopping',
                'meta_description'=>'H-Shopping online shopping',
                'meta_keywords'=>'H-Shopping, online shopping , E-commerce website ',
                'logo'=>'frontend/img/logo.png',
                'favicon'=>'',
                'email'=>'h.shopping@gmail.com',
                'phone'=>'0325106177',
                'address'=>'Da Nang city',
                'footer'=>'',
                'facebook_url'=>'',
                'twitter_url'=>'',
                'instagram_url'=>'',
                'google_url'=>'',
                'printerest'=>''


            ]
        );
    }
}
