<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/setup',function(){ 
    $credentials = [
        "email" => "badr@gmail.com",
        "password" => "password123"
    ];
    if(!Auth::attempt($credentials)){
        $user = new User();
        $user->name = "Azouz";
        $user->email = $credentials["email"];
        $user->password = Hash::make($credentials["password"]);
        $user->save();
        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            $admin_token = $user->createToken("admin-token",["create","update","delete"]);
            $update_token = $user->createToken("update-token",["create","update"]);
            $basic_token = $user->createToken("basic-token");
            return [
                "admin" => $admin_token->plainTextToken,
                "update" => $update_token->plainTextToken,
                "basic" => $basic_token->plainTextToken,
            ];
        }
    }
});

require __DIR__.'/auth.php';
