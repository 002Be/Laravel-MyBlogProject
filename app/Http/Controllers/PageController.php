<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class PageController extends Controller
{
    public function index(){
        $pages = Page::all();
        return view("back.pages.index", compact("pages"));
    }

    public function create(){
        return view("back.pages.create");
    }

    public function update($id){
        $pages = Page::findOrFail($id);
        return view("back.pages.update", compact("pages"));
    }

    public function switch(Request $request){
        $pages = Page::findOrFail($request->id);
        $pages->status=$request->statu=="true" ? 1 : 0;
        $pages->save();
    }

    public function post(Request $request){
        $request->validate([
            "title" => "min:3",
            "image" => "required | image | mimes:jpeg, png, jpg, gif | max:2048"
        ]);

        $pages = new Page();
        $pages->title = $request->title;
        $pages->content = $request->content;
        $pages->slug = Str::slug($request->title,"-");
        $last = Page::orderBy("order","DESC")->first();
        $pages->order = $last->order+1;
        if($request->hasFile('image')){
            $imageName = Str::slug($request->title,"-").'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $pages->image = 'uploads/'.$imageName;
        }
        $pages->save();
        toastr()->success('Sayfa oluşturuldu', 'Başarılı');
        return redirect()->route('admin.page.index');
    }

    public function updatePost(Request $request, int $id)
    {
        $request->validate([
            "title" => "min:3",
            "image" => "image | mimes:jpeg, png, jpg, gif | max:2048"
        ]);

        $pages = Page::findOrFail($id);
        $pages->title = $request->title;
        $pages->content = $request->content;
        $pages->slug = Str::slug($request->title,"-");
        if($request->hasFile('image')){
            $imageName = Str::slug($request->title,"-").'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $pages->image = 'uploads/'.$imageName;
        }
        $pages->save();
        toastr()->success('Sayfa düzenlendi', 'Başarılı');
        return redirect()->route('admin.page.index');
    }

    public function delete($id){
        $pages = Page::find($id);
        if(File::exists($pages->image)){
            File::delete(public_path($pages->image));
        }
        $pages->delete();
        toastr()->success('Sayfa kalıcı olarak silindi', 'Başarılı');
        return redirect()->route("admin.page.index");
    }

    public function orders(Request $request){
        foreach($request->get("page") as $key => $order){
            Page::where("id",$order)->update(['order'=>$key]);
        }
    }
}
