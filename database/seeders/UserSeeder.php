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
        \DB::table("users")->insert([
            "username" => "admin",
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => \Hash::make("admin"),
            "department_id" => "1",
            "status_id" => "1"
        ]);
        // \DB::table("users")->insert([
        //     "avatar" => "https://cdn-icons-png.flaticon.com/512/6386/6386976.png",
        //     "username" => "user3",
        //     "name" => "Trum Cuoi",
        //     "email" => "user3@gmail.com",
        //     "password" => \Hash::make("user"),
        //     "department_id" => "1",
        //     "status_id" => "1"
        // ]);
    }
}