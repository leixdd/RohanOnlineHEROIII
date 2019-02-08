<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdminCMS;

class ManagePost extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function savePost(Request $request){
        $r = AdminCMS::create([
            "post_title" => $request->input("post_title"),
            "post_content" => $request->input("post_content")
        ]);

        if($r) {

            return response([
                "success" => true
            ]);
        }

        
        return response([
            "success" => false
        ]);
    }
}
