<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Redirect;

   
class CategoryController extends Controller
{
   public function index(Request $request){
           
          $user = User::findOrFail(auth()->id());
          if($user->is_admin==1){
            $categories = Category::with("user")
            ->name($request->name) 
            ->description($request->description) 
            ->order($request->order)
            ->paginate(5);
          }else{
            $categories = Category::where("user_id",$user->id)->with("user")
            ->name($request->name)
            ->description($request->description) 
            ->order($request->order)
            ->paginate(5);
          }

        return view("admin.categories.list" , ["list" => $categories] );//category list etmek için kullandığımız function.
     }

   public function create() {

        return view("admin.categories.create-update"); //category create ve update etmek için kullandığımız function.

     }
     
   public function store(Request $request) {
       

       try{

        $request->validate([
         "name" => ["required", "string"],
         "slug" => ["max:255"],
         "description" => ["max:255"],
         "seo_keywords" => ["max:255"], 
         "seo_description" => ["max:255"]
       ]);
  
         $category = new Category () ;
         $category->name = $request->name ;
         $category->slug = $request->slug ;
         $category->description = $request->description ;
         $category->status = $request->status ? 1 : 0 ;
         $category->feature_status = $request->feature_status ? 1 : 0 ;
         $category->seo_keywords = $request->seo_keywords;
         $category->seo_description = $request->seo_description;
         $category->user_id = auth()->id();
         $category->order = $request->order ;
         
         $category->save();
         return redirect()->route('category.index');
         
       } catch( \Exception $exception) {
         abort(404, $exception->getMessage());
       }
   }

   public function changeStatus(Request $request) {

      $request->validate([            // id var mı yok mu onu sorgulamak için yaptığımız bir işlem.
        "id"=> ["required","integer"] 
      ]);
      $categoryID = $request->id; //requestten gelen sorgu sonucu gelen id yi categoryIdye eşitledik.
         
      $category=Category::where("id", $categoryID)->first() ;//koşul yazıyoruz kategori tablısundan çağırıp idsi gelen id olan değerin kendisini bul.
      $category->status= !$category->status ; // yetkili id'nin statusu nu 0 ise 1 , 1 ise 0 yapıcak.
      $category->save(); //veritabanına kayıt ediyoruz.
      return redirect()->route("category.index");
   }

   public function changeFeatureStatus(Request $request) {

      $request->validate([            // id var mı yok mu onu sorgulamak için yaptığımız bir işlem.
        "id"=> ["required","integer"] 
      ]);
      $categoryID = $request->id; //requestten gelen sorgu sonucu gelen id yi categoryIdye eşitledik.
         
      $category=Category::where("id", $categoryID)->first() ;//koşul yazıyoruz kategori tablısundan çağırıp idsi gelen id olan değerin kendisini bul.
      $category->feature_status= !$category->feature_status ; // yetkili id'nin statusu nu 0 ise 1 , 1 ise 0 yapıcak.
      $category->save(); //veritabanına kayıt ediyoruz.
      return redirect()->route("category.index");
       
   }

   public function delete(Request $request) {
      $request->validate([
        "id" => ["required", "integer"]
      ]);

      $category = Category::findOrFail($request->id);
      $articles = Article::where("category_id", $request->id)->get();

      foreach ($articles as $article) {
          $article->delete();
      }
      $category->delete();

      return redirect()->route("category.index");
   
   }

   public function edit(Request $request) {
      
       $categories =Category::all();
       $categoryID = $request->id ;
       $category=Category::where("id", $categoryID)->first(); 

       if(is_null($category)) {
         $statusText="Category Delete";

       }
       return view("admin.categories.create-update", compact("category","categories")); //compact değişken isimlerini ve değerlerini dizi olarak döndürür.
   
   }

   public function update(Request $request) {
      $request->validate([
          "name" => ["required", "string"],
          "slug" => ["max:255"],
          "description" => ["max:255"],
          "seo_keywords" => ["max:255"], 
          "seo_description" => ["max:255"]
      ]);
  
      $category = Category::findOrFail($request->id);
      // Kategori bilgilerini güncelle
      $category->name = $request->name ;
      $category->slug = $request->slug;
      $category->description = $request->description ;
      $category->status = $request->status ? 1 : 0 ;
      $category->feature_status = $request->feature_status ? 1 : 0 ;
      $category->seo_keywords = $request->seo_keywords;
      $category->seo_description = $request->seo_description;
      $category->order = $request->order ;
  
      $category->save(); // Veritabanında güncelle
  
      return redirect()->route("category.index");
  }
} 
