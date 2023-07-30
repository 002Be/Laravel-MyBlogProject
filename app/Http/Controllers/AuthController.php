<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view("back.auth.login");
    }

    public function loginPost(Request $request){
        if(
            Auth::attempt([
                "mail" => $request->mail,
                "password" => $request->password
            ])
        ){
            toastr()->success('Tekrardan hoşgeldiniz '.Auth::user()->name, 'Giriş Yapıldı');
            return redirect()->route("admin.dashboard");
        }else{
            return redirect()->route("admin.login")->withErrors("Parola veya E-Posta hatalı!");
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route("admin.login")->with("success","Çıkış yapıldı");
    }
}
