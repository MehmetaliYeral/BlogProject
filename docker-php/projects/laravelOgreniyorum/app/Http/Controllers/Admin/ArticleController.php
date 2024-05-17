<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\Auth\LoginCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Admin\Alert ;
use App\Http\Requests\Auth\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class ArticleController extends Controller
{
     public function index(Request $request ){
          $user = User::findOrFail(auth()->id());

          if($user->is_admin==1){
            $articles = Article::with("user")
            ->title($request->title)
            ->slug($request->slug) 
            ->body($request->body)
            ->tags($request->tags)
            ->order($request->order)
            ->paginate(5);
          }else{
            $articles = Article::where("user_id",$user->id)->with("user")
            ->title($request->title)
            ->slug($request->slug) 
            ->body($request->body)
            ->tags($request->tags)
            ->order($request->order)
            ->paginate(5);
          }
          
        return view("admin.articles.list", ["list" => $articles]); //article list etmek için kullandığımız function.
     }

     public function create() {
               
      $categories = Category::all();

        return view("admin.articles.create-update",compact("categories")); //article create ve update etmek için kullandığımız function.

     }

    public function changeStatus(Request $request) {
 
         
      $request->validate([            // id var mı yok mu onu sorgulamak için yaptığımız bir işlem.
         "id"=> ["required","integer"] 
       ]);
       $articleID = $request->id;
       $article = Article::where("id",$articleID)->first();
       $article->status = !$article->status ;
       $article->save();
       return redirect()->route("article.index");
    } 

   public function store(LoginCreateRequest $request) { // article creat 
     
        
        $article = new Article () ;
        $article->title = $request->title ;
        $article->slug = $request->slug ;
        $article->status = $request->status ? 1 : 0 ;
        $article->seo_keywords = $request->seo_keywords ;
        $article->seo_description = $request->seo_description ;
        $article->body = $request->body ;
        $article->tags = $request->tags ;
        $article->user_id = auth()->id();
        $article->category_id = $request->category_id ;
 
        $article->save() ;
        return redirect()->route('article.index') ;

}
   public function edit(Request $request, int $articleID) { //article edit    
        
      $article = Article::find($articleID);
      
      $categories =Category::all();
      $users=User::all();


       if(is_null($article)) {
         $statusText="Article not found" ;
         return redirect()->route("article.index");
       }
       return view("admin.articles.create-update", compact("article", "categories", "users"));

   }
  
   public function update(ArticleUpdateRequest $request) // article update 
   {
     
       $id = $request->id;
       $article = Article::findOrFail($id);
   
       $data = $request->all();
       $article->update($data);

       $article->save();
       return redirect()->route("article.index");

   }
 
   public function delete(Request $request) {         // article delete
      $request->validate([
          "id" => ["required", "integer"]
      ]);
  
      $articleID = $request->id;

      $article = Article::findOrFail($articleID);
      $categories = Category::where("user_id", $article->user_id)->get();
      foreach ($categories as $category) {
          $category->delete();
      }
  
      $article->delete();
  
      return redirect()->route("article.index");
  }
  
   
   
}
