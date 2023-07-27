<?php

use Illuminate\Support\Facades\Route;
// |Back Routes---------------------------------------------------------------------------
Route::prefix("admin")->name("admin.")->middleware("isAdmin")->group(function(){
    //? Prefix sayesinde Route::get('admin/panel',[App\Http\Controllers\Dashboard::class, 'index'])->name("admin.dashboard"); yazmak yerine Route::get('panel',[App\Http\Controllers\Dashboard::class, 'index'])->name("dashboard"); yazıyoruz
    Route::get('panel',[App\Http\Controllers\Dashboard::class, 'index'])->name("dashboard");
    Route::get('cikis',[App\Http\Controllers\AuthController::class, 'logout'])->name("logout");

    //||Ayarlar Routes-------------------------------
    Route::get('/ayarlar', [App\Http\Controllers\ConfigController::class, 'index'])->name("config.index");
    Route::post('/ayarlar/update', [App\Http\Controllers\ConfigController::class, 'update'])->name("config.update");
    //||Ayarlar Routes-------------------------------

    //||Sayfalar Routes-------------------------------
    Route::get('/sayfalar', [App\Http\Controllers\PageController::class, 'index'])->name("page.index");
    Route::get('/sayfalar/create', [App\Http\Controllers\PageController::class, 'create'])->name("page.create");
    Route::get('/sayfalar/status', [App\Http\Controllers\PageController::class, 'switch'])->name("page.switch");
    Route::post('/sayfalar/create', [App\Http\Controllers\PageController::class, 'post'])->name("page.create.post");
    Route::get('/sayfalar/order', [App\Http\Controllers\PageController::class, 'orders'])->name("page.orders");
    Route::get('/sayfalar/delete/{id}', [App\Http\Controllers\PageController::class, 'delete'])->name("page.delete");
    Route::get('/sayfalar/update/{id}', [App\Http\Controllers\PageController::class, 'update'])->name("page.update");
    Route::post('/sayfalar/update/{id}', [App\Http\Controllers\PageController::class, 'updatePost'])->name("page.update.post");
    //||Sayfalar Routes-------------------------------

    //||Kategori Routes-------------------------------
    Route::get('/kategoriler', [App\Http\Controllers\KategorieController::class, 'index'])->name("categorie.index");
    Route::post('/kategoriler/create', [App\Http\Controllers\KategorieController::class, 'create'])->name("categorie.create");
    Route::post('/kategoriler/update', [App\Http\Controllers\KategorieController::class, 'update'])->name("categorie.update");
    Route::get('/kategoriler/delete', [App\Http\Controllers\KategorieController::class, 'delete'])->name("categorie.delete");
    Route::get('/kategoriler/status', [App\Http\Controllers\KategorieController::class, 'switch'])->name("categorie.switch");
    Route::get('/kategoriler/getData', [App\Http\Controllers\KategorieController::class, 'getData'])->name("categorie.getdata");
    //||Kategori Routes-------------------------------

    //||Makale Routes-------------------------------
    Route::get("/makaleler/silinenler",[App\Http\Controllers\ArticleController::class, 'trashed'])->name("trashed.article");
    Route::resource('makaleler','App\Http\Controllers\ArticleController');
    Route::get("/switch",[App\Http\Controllers\ArticleController::class, 'switch'])->name("switch");
    Route::get("/deleteArticle/{id}",[App\Http\Controllers\ArticleController::class, 'delete'])->name("delete.article");
    Route::get("/hardDeleteArticle/{id}",[App\Http\Controllers\ArticleController::class, 'hardDelete'])->name("hard.delete.article");
    Route::get("/recoverArticle/{id}",[App\Http\Controllers\ArticleController::class, 'recover'])->name("recover.article");
    //||Makale Routes-------------------------------
});
Route::prefix("admin")->name("admin.")->middleware("isLogin")->group(function(){
    Route::get('giris',[App\Http\Controllers\AuthController::class, 'login'])->name("login");
    Route::post('giris',[App\Http\Controllers\AuthController::class, 'loginPost'])->name("login.post");
});
// |Back Routes---------------------------------------------------------------------------


// |Front Routes--------------------------------------------------------------------------
Route::get('/site-bakimda',function(){return view("front.offline");}); //Ofline Page
Route::get('/', [App\Http\Controllers\Homepage::class, 'index'])->name("homepage");
Route::get('/sayfa/{sayfa}', [App\Http\Controllers\Homepage::class, 'page'])->name("page");
Route::get('/iletisim',[App\Http\Controllers\Homepage::class, 'contact'])->name("contact");
Route::post('/iletisim', [App\Http\Controllers\Homepage::class, 'contactPost'])->name("contact.post");
Route::get('/kategoriler/{categorie}/{slug}', [App\Http\Controllers\Homepage::class, 'single'])->name("single");
Route::get('/{categorie}', [App\Http\Controllers\Homepage::class, 'categorie'])->name("categorie");
// |Front Routes--------------------------------------------------------------------------
?>