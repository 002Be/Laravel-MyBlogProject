<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Config;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        view()->share("config", Config::find(1)); //Config modeli tüm sayfalara gönderildi
        Route::resourceVerbs([
            "create"=>"olustur",
            "edit"=>"duzenle"
        ]);
    }
}
