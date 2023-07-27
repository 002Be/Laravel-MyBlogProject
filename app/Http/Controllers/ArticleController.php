<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Categorie;

class ArticleController extends Controller
{
    // Display a listing of the resource.
    public function index() //* Görüntülemek için kullanılır
    {
        $articles = Article::orderBy("created_at","DESC")->get();
        return view("back.articles.index", compact("articles"));
    }

    // Show the form for creating a new resource.
    public function create() //* Oluşturma sırasında formdaki öğeler (Section içindeki otionsları sıralamak vb.) için kullanılır
    {
        $categories = Categorie::orderBy("created_at","ASC")->get();
        return view("back.articles.create", compact("categories"));
    }

    // Store a newly created resource in storage.
    public function store(Request $request) //* Oluşturmak için kullanılır
    {
        $request->validate([
            "title" => "min:3",
            "image" => "required | image | mimes:jpeg, png, jpg, gif | max:2048"
        ]);

        $article = new Article;
        $article->title = $request->title;
        $article->categorie_id = $request->categorie;
        $article->content = $request->content;
        $article->slug = Str::slug($request->title,"-");
        if($request->hasFile('image')){
            $imageName = Str::slug($request->title,"-").'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/'.$imageName;
        }
        $article->save();
        toastr()->success('Makale oluşturuldu', 'Başarılı');
        return redirect()->route('admin.makaleler.index');
    }

    // Display the specified resource.
    public function show(string $id)
    {
        //
    }

    // Show the form for editing the specified resource.
    public function edit(string $id) //* Düzenleme sırasında formdaki öğeler (Section içindeki otionsları sıralamak vb.) için kullanılır
    {
        $article = Article::findOrFail($id);
        $categories = Categorie::orderBy("created_at","ASC")->get();
        return view("back.articles.update", compact("categories", "article"));
    }

    // Update the specified resource in storage.
    public function update(Request $request, string $id) //* Düzenlemek için kullanılır
    {
        $request->validate([
            "title" => "min:3",
            "image" => "image | mimes:jpeg, png, jpg, gif | max:2048"
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->categorie_id = $request->categorie;
        $article->content = $request->content;
        $article->slug = Str::slug($request->title,"-");
        if($request->hasFile('image')){
            $imageName = Str::slug($request->title,"-").'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/'.$imageName;
        }
        $article->save();
        toastr()->success('Makale düzenlendi', 'Başarılı');
        return redirect()->route('admin.makaleler.index');
    }

    public function switch(Request $request){
        $article = Article::findOrFail($request->id);
        $article->status=$request->statu=="true" ? 1 : 0;
        $article->save();
    }

    // Remove the specified resource from storage.
    public function destroy(string $id) //* Silmek için kullanılır
    {
        
    }

    public function delete($id){
        Article::findOrFail($id)->delete();
        toastr()->success('Makale silindi', 'Başarılı');
        return redirect()->route('admin.makaleler.index');
    }

    public function trashed(){
        $articles = Article::onlyTrashed()->orderBy("deleted_at","DESC")->get();
        return view("back.articles.trashed", compact("articles"));
    }

    public function recover($id){ //* Silmekten kurtar
        Article::onlyTrashed()->findOrFail($id)->restore();
        toastr()->success('Makale geri alındı', 'Başarılı');
        return redirect()->back();
    }

    public function hardDelete($id){
        $article = Article::onlyTrashed()->findOrFail($id);
        if(File::exists($article->image)){
            File::delete(public_path($article->image));
        }

        $article->forceDelete();
        toastr()->success('Makale kalıcı olarak silindi', 'Başarılı');
        return redirect()->back();
    }
}
