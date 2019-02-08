<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use CusAuth;
use App\Model\RohanUser;

class Helpers extends Controller
{
    public function __construct(){
        $this->middleware('cusauth');
    }

    public static function getSeller($id) {
        return RohanUser::where("user_id", $id)->get()[0]->login_id;
    }
}
