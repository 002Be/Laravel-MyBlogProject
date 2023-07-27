<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("admins")->insert([
            "name"=>"admin",
            "mail"=>"admin@admin.com",
            "password"=> bcrypt("admin1234")
        ]);
    }
}
