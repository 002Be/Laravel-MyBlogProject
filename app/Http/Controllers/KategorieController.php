<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Article;

class KategorieController extends Controller
{
    public function index(){
        $categories = Categorie::all();
        return view("back.categories.index", compact("categories"));
    }

    public function switch(Request $request){
        $categorie = Categorie::findOrFail($request->id);
        $categorie->status=$request->statu=="true" ? 1 : 0;
        $categorie->save();
    }

    public function create(Request $request){
        $request->validate([
            "name" => "min:2",
        ]);
        $isExist = Categorie::whereSlug(Str::slug($request->name,"-"))->first();
        if($isExist){
            //! Sayfadaki JS kodlarını bozuyor | Bunun yerine https://github.com/mckenziearts/laravel-notify kütüphanesi kullanılacak
            toastr()->error($request->name.' adında bir kategori zaten mevcut!', 'Başarısız');
            return redirect()->back();
        }
        $categorie = new Categorie();
        $categorie->name = $request->name;
        $categorie->slug = Str::slug($request->name,"-");
        $categorie->save();
        //! Sayfadaki JS kodlarını bozuyor | Bunun yerine https://github.com/mckenziearts/laravel-notify kütüphanesi kullanılacak
        toastr()->success('Kategori oluşturuldu', 'Başarılı');
        return redirect()->back();
    }

    public function getData(Request $request){
        $categorie = Categorie::findOrFail($request->id);
        return response()->json($categorie);
    }

    public function update(Request $request){
        $request->validate([
            "name" => "min:2",
        ]);
        $isSlug = Categorie::whereSlug(Str::slug($request->slug,"-"))->whereNotIn("id", [$request->id])->first();
        $isName = Categorie::whereName($request->name)->whereNotIn("id", [$request->id])->first();
        if($isSlug or $isName){
            //! Sayfadaki JS kodlarını bozuyor | Bunun yerine https://github.com/mckenziearts/laravel-notify kütüphanesi kullanılacak
            // toastr()->error($request->name.' adında bir kategori zaten mevcut!', 'Başarısız');
            return redirect()->back();
        }
        $categorie = Categorie::find($request->id);
        $categorie->name = $request->name;
        $categorie->slug = Str::slug($request->slug,"-");
        $categorie->save();
        //! Sayfadaki JS kodlarını bozuyor | Bunun yerine https://github.com/mckenziearts/laravel-notify kütüphanesi kullanılacak
        // toastr()->success('Kategori güncellendi', 'Başarılı');
        return redirect()->back();
    }

    public function delete(Request $request){
        $categorie = Categorie::findOrFail($request->id);
        if($categorie->id==1){
            //! Sayfadaki JS kodlarını bozuyor | Bunun yerine https://github.com/mckenziearts/laravel-notify kütüphanesi kullanılacak
            // toastr()->error('Bu kategori silinemez!', 'Başarısız');
            return redirect()->back();
        }
        $count = $categorie->articleCount();
        $defaultCategorie = Categorie::find(1)->name;
        if($count>0){
            Article::where("categorie_id", $categorie->id)->update([
                "categorie_id"=>1
            ]);
            //! Sayfadaki JS kodlarını bozuyor | Bunun yerine https://github.com/mckenziearts/laravel-notify kütüphanesi kullanılacak
            toastr()->success('Kategori silindi | Bu kategoriye ait '.$count.' makale '.$defaultCategorie.' kategorisine aktarıldı!', 'Başarılı');
        }else{
            toastr()->error('Kategori silindi', 'Başarılı');
        }
        $categorie->delete();
        return redirect()->back();
    }
}
