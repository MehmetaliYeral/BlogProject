<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
     protected $guarded= ["id" , "created_at" , "updated_at"] ; //hangi alanlar boş bırakılsın diye yaptığımız bir array.

     public function user() {
        return $this->hasOne(User::class, "id", "user_id");  //user tablosu ile ilişki kuruyor.
       }

  
     public function scopeTitle($query, $title) //requesten gelen name null değilse bu sıralamaya göre filter yap.
     {
         if (!is_null($title)) {
             return $query->orWhere('title', 'like', '%' . $title . '%');
}
     }

     public function scopeSlug($query, $slug) //requesten gelen name null değilse bu sıralamaya göre filter yap.
     {
         if (!is_null($slug)) {
             return $query->where('title', 'like', '%' . $slug . '%');
}
     }

     public function scopeBody($query, $body) //requesten gelen name null değilse bu sıralamaya göre filter yap.
     {
         if (!is_null($body)) {
             return $query->where('title', 'like', '%' . $body . '%');
}
     }

     public function scopeTags($query, $tags) //requesten gelen name null değilse bu sıralamaya göre filter yap.
     {
         if (!is_null($tags)) {
             return $query->where('title', 'like', '%' . $tags . '%');
}
     }

     public function scopeOrder($query, $order) //requesten gelen name null değilse bu sıralamaya göre filter yap.
     {
         if (!is_null($order)) {
             return $query->where('title', 'like', '%' . $order . '%');
}
     }

    

    }
   
