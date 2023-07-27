<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConfigSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("configs")->insert([
            "title"=>"Blog Sitesi",
        ]);
    }
}
