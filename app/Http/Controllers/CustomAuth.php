<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomAuth extends Controller
{
    
    public static function Auth($user){
        session(['user' => $user]);
        return true;
    }

    public static function user(){
        return session('user') !== null ? ( (object) session('user'))[0] : false;
    }

    public static function logout(){
        session()->forget('user');
    }
}
