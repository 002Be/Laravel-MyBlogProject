<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Config;

class ConfigController extends Controller
{
    public function index(){
        $config = Config::find(1);
        return view("back.config.index", compact("config"));
    }

    public function update(Request $request){
        $config = Config::findOrFail(1);
        $config->title = $request->title;
        $config->active = $request->active;
        $config->linkedin = $request->linkedin;
        $config->github = $request->github;
        if($request->hasFile('logo')){
            $logoName = Str::slug($request->title,"-").'-logo.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'), $logoName);
            $config->logo = 'uploads/'.$logoName;
        }
        if($request->hasFile('favicon')){
            $faviconName = Str::slug($request->title,"-").'-favicon.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'), $faviconName);
            $config->favicon = 'uploads/'.$faviconName;
        }
        $config->save();
        toastr()->success('Site ayarları düzenlendi', 'Başarılı');
        return redirect()->route('admin.config.index');
    }
}
