<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    protected $guarded=["id", "created_at", "updated_at"]; //hangi alanlar boş bırakılsın diye yaptığımız bir array.

       public function user() {
        return $this->hasOne(User::class, "id", "user_id");  //user tablosu ile ilişki kuruyor.
       }
       
       public function scopeName($query, $name) {
          
        if(!is_null($name)) { //requesten gelen name null değilse bu sıralamaya göre filter yap.

          return $query->where("name", "LIKE", "%" . $name . "%");
        }
      
       }

     public function scopeDescription($query, $description) {
        if(!is_null($description)) {
            return $query->orWhere("description", "LIKE", "%" . $description . "%");
        }
     }
     
     public function scopeOrder($query, $order) {
        if(!is_null($order)) {
            return $query->orWhere("order", "LIKE", "%" . $order . "%");
        }
     }

   
}

