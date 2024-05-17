<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;


Route::prefix("admin")->group(function(){

Route::get("/",function(){
    return view("admin.index");
})->name("admin.index"); //Anasayfaya yönlendiren route.


  //Article Route 
Route::get("articles", [ArticleController::class, "index"])   
->name("article.index"); //Makalelerimiz listelemek için kullandığımız route.

Route::get("articles/create", [ArticleController::class, "create"])
->name("article.create"); //Makalelerimiz oluşturmak ve update etmek için kulladığımız get isteği.

Route::post("articles/change-status", [ArticleController::class,"changeStatus"])->name("articles.changeStatus");

Route::post("articles/create", [ArticleController::class, "store"]);//Makalelerimiz oluşturmak ve update etmek için kulladığımız post isteği.

Route::get("articles/{id}/edit", [ArticleController::class, "edit"])->name("article.edit");

Route::post("articles/{id}/edit", [ArticleController::class, "update"]);

Route::post("articles/delete", [ArticleController::class, "delete"])->name("articles.delete");



  //Category Route
Route::get("categories", [CategoryController::class, "index"])
->name("category.index"); //Kategori listelemek için kullandığımız route.

Route::get("categories/create", [CategoryController::class, "create"])
->name("category.create"); //Kategori oluşturmak ve update etmek için kulladığımız route.

Route::post("categories/create", [CategoryController::class, "store"]); //Kategori oluşturmak ve update etmek için kulladığımız route.(post)

Route::post("categories/change-status", [CategoryController::class, "changeStatus"])->name("categories.changeStatus");

Route::post("categories/change-feature-status", [CategoryController::class, "changeFeatureStatus"])->name("categories.changeFeatureStatus");

Route::post("categories/delete", [CategoryController::class, "delete"])->name("categories.delete");

Route::get("categories/{id}/edit", [CategoryController::class, "edit"])->name("categories.edit")->whereNumber("id");

Route::post("categories/{id}/edit", [CategoryController::class, "update"])->whereNumber("id");

});


Route::get("/",function(){
    return view("admin.index");
})->name("home"); //Anasayfaya yönlendiren route.

 //Login - Register - User Route

Route::get("/login", [LoginController::class, "showLogin"])->name("Login");

Route::post("/login", [LoginController::class, "login"]);


Route::get("/Register", [LoginController::class,"showRegister"])->name("Register");

 Route::post("/Register",[LoginController::class, "Register"]);

Route::post("/lOut", [LoginController::class, "lOut"])->name("lOut");

Route::get("/userlist", [LoginController::class, "userList"])->name("userlist");



Route::get("/home",function(){
     return view("index");
}) ;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
