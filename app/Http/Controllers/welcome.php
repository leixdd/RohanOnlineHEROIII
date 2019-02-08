<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\AdminCMS;
use App\Model\RohanUser;
use App\Model\GameCharLogin;

class welcome extends Controller
{
    
    public function index(){
        $cms = AdminCMS::get(['id', 'post_title', 'created_at']);
        $regUsers = RohanUser::count();
        $cLogins = GameCharLogin::where("login", 1)->count();

        return view('welcome', compact('cms', 'regUsers', 'cLogins'));
    }
    
}
