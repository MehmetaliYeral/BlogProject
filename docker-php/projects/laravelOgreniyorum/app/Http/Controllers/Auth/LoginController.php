<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 

class LoginController extends Controller
{
    public function showLogin() {    //login kısmını göstermek için yazdığımız bir controller.
        return view("auth.login");
    }

    public function showRegister(){  //register kısmını göstermek için yazdığımız bir controller.
         return view("auth.register");
    }

   public function login(LoginRequest $request){
        $email=$request->email;
        $password=$request->password;
        $user = User::where("email", $email)->first();
        
        Auth::login($user); 

        return redirect()->route("admin.index");

        dd($request->all());
    }

    public function lOut(Request $request) {
         Auth::logout();
         return redirect()->route("Login");
    }

   public function Register(Request $request){
        
    $request->validate([
       "name" => "required",
       "email" => "required" ,
       "password" => "required",

    ]);
        if(User::where("email",$request->email)->exists()){
            return back()->withErrors([ "email" => "Kullanılıyor."]);
        }

        User::create([
            "name"  => $request->name,
            "email" => $request->email,
            "password" =>Hash::make($request->password),
        ]);

        return redirect()->route("admin.index");
   }
 
   public function userList(Request $request) {
         $categories = Category::with("user")->get();

         return view("admin.userList", ["userlist" => $categories]);
         
   }
}
   
   


