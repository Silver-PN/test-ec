<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table("users")->insert([
        //     "username" => "admin",
        //     "name" => "Admin",
        //     "email" => "admin@gmail.com",
        //     "password" => \Hash::make("admin"),
        //     "department_id" => "1",
        //     "status_id" => "1"
        // ]);
        \DB::table("users")->insert([
            "username" => "Silver-PN",
            "name" => "Silver",
            "email" => "silverpn@gmail.com",
            "password" => \Hash::make("13072002"),
            "department_id" => "1",
            "status_id" => "1"
        ]);
    }
}
