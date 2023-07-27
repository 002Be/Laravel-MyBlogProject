<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Page;

class Dashboard extends Controller
{
    public function index(){
        $article=Article::all()->count();
        $hit=Article::sum("hit");
        $categorie=Categorie::all()->count();
        $page=Page::all()->count();
        return view("back.dashboard", compact("article", "hit", "categorie", "page"));
    }
}
