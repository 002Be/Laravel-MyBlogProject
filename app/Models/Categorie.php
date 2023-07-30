<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function articleCount(){
        return $this->hasMany("App\Models\Article","categorie_id", "id")->where("status",1)->count();
    }
}
