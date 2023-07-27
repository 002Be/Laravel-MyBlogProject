<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Validator;
use Mail;
use Illuminate\Mail\Mailable;

use App\Models\Categorie; //? Models çağrılır
use App\Models\Article; //? Models çağrılır
use App\Models\Page; //? Models çağrılır
use App\Models\Contact; //? Models çağrılır
use App\Models\Config; //? Models çağrılır

class Homepage extends Controller
{
    public function __construct() //? Tüm fonskiyonlarda çalışır
    {
        if(Config::find(1)->active==0){
            return redirect()->to("site-bakimda")->send();
        }
        view()->share("pages", Page::where("status",1)->orderBy("order","ASC")->get());
        view()->share("categories", Categorie::where("status",1)->orderBy("created_at","DESC")->get());
    }

    public function index(){
        // $data["articles"] = Article::orderBy("created_at","DESC")->get(); //? get yerine paginate yazarsak bu listelemeyi sayfalandırabiliriz
        $data["articles"] = Article::with("getCategorie")->where("status",1)->whereHas("getCategorie",function($query){
            $query->where("status",1);
        })->orderBy("created_at","DESC")->paginate(8); //? Modelden gelen veriler dizinin içine kaydedilir
        return view("front.homepage", $data); //? Dizi gösterilecek sayfaya yönlendirilir
    }

    public function single($categorie, $slug){
        // $article=Article::whereSlug($slug)->first() ?? abort(404, "Böyle bir blog bulunamadı.");
        // dd($article);

        $categorie = Categorie::where("slug", $categorie)->first() ?? abort(404, "Böyle bir kategori bulunamadı.");

        $article = Article::where("slug", $slug)->where("categorie_id",$categorie->id)->first() ?? abort(404, "Böyle bir yazı bulunamadı.");
        $article->increment("hit");
        $data["article"] = $article;
        return view("front.single", $data);
    }

    public function categorie($slug){
        $categorie = Categorie::where("slug", $slug)->first() ?? abort(404, "Böyle bir kategori bulunamadı.");
        $data["categorie"] = $categorie;
        // $data["articles"] = Article::where("categorie_id", $categorie->id)->orderBy("created_at","DESC")->get();
        $data["articles"] = Article::where("categorie_id", $categorie->id)->where("status",1)->orderBy("created_at","DESC")->paginate(3);
        return view("front.categorie", $data);
    }

    public function page($slug){
        $page = Page::where("slug", $slug)->first() ?? abort(404, "Böyle bir kategori bulunamadı.");
        $data["page"] = $page;
        return view("front.page", $data);
    }

    public function contact(){
        return view("front.contact");
    }

    public function contactPost(Request $request){
        // $rules = [
        //     "name" => "required | min:5",
        //     "mail" => "required | email",
        //     "subject "=> "required",
        //     "message" => "required | min:10"
        // ];
        // $validate = Validator::make($request->post(),$rules);
        // if($validate->fails()){
        //     return redirect()->route('contact')->withErrors($validate)->withInput();
        // }

        $contact = new Contact;
        $contact->name=$request->name;
        $contact->mail=$request->mail;
        $contact->subject=$request->subject;
        $contact->message=$request->message;
        $contact->save();

        Mail::raw("
                    Mesajı Gönderen : ".$request->name."
                    Mesajı Gönderen Mail : ".$request->mail."
                    Mesaj Konusu : ". $request->subject."
                    Mesaj : ".$request->message."
                    Mesaj Gönderilme Tarihi : ".date('d.m.Y H:i')."", function($message) use($request){
            $message->from("iletisim@blogsitesi.com", "Blog Sitesi");
            $message->to("iletisim@blogsitesi.com");
            $message->subject($request->name. " iletişimden mesaj gönderdi!");
        });

        return redirect()->route("contact")->with("success","Mesaj başarıyla iletildi");
    }
}
