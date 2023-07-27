<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        for($i=0; $i<10; $i++){
            $title = $faker->sentence(6);
            DB::table("articles")->insert([
                "categorie_id" => rand(1,7),
                "title" => $title,
                "image" => $faker->imageUrl(640, 480, 'cats', true, "Blog Sitesi"),
                "content" => $faker->paragraph(6),
                "slug" => Str::slug($title,"-"),
            ]);
        }
    }
}
