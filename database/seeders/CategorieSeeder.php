<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories=["Genel","Eğlence","Bilişim","Gezi","Teknoloji","Sağlık","Spor","Günlük Yaşam"];
        foreach($categories as $categorie){
            DB::table("categories")->insert([
                "name"=>$categorie,
                "slug"=>Str::slug($categorie,"-")
            ]);
        }
    }
}
