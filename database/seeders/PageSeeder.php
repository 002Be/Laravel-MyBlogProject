<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages=["Hakkımızda","Kariyer","Vizyon","Misyon"];
        $count=0;
        foreach($pages as $page){
            $count++;
            DB::table("pages")->insert([
                "title"=>$page,
                "content"=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit cupiditate fuga, fugit enim est molestiae iure suscipit possimus reiciendis, nisi quas recusandae saepe soluta rem! Voluptas animi recusandae laudantium modi.",
                "order"=>$count,
                "image"=>"https://picsum.photos/id/1/640/480",
                "slug"=>Str::slug($page,"-")
            ]);
        }
    }
}
