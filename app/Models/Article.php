<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    public function getCategorie(){
        return $this->hasOne("App\Models\Categorie","id","categorie_id");
    }
}