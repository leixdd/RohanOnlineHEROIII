<?php

namespace App\Http\Controllers\USM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CusAuth;
use Validator;
use App\Model\RohanUser;

class LoginController extends Controller
{
    
    public function doLogout(){
        CusAuth::logout();
        return redirect('welcome');
    }

    public function doLogin(Request $request) {

        $x = RohanUser::where([ 
            ['login_id', '=', $request->input('username')],
            ['login_pw', '=', md5($request->input('password'))]
            ])->count();

        if($x > 0) {

            $user = RohanUser::where([ 
                ['login_id', '=', $request->input('username')],
                ['login_pw', '=', md5($request->input('password'))]
            ])->get();

            CusAuth::Auth($user);
            
            if($request->ajax()){
                return response([
                    "success" => true,
                    "message" => 'Logged in Successfully'
                ]);
            }

            return redirect('/')->with('message', 'Logged in Successfully');

        }

       

        return redirect()->back()->with('errorNE', 'Error! Wrong Credentials');
                   
        
    }

    public function showLogin() {
        if(CusAuth::user()) {
            return redirect('/');
        }
        return view('modules.login');
    }
}
