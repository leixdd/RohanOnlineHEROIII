<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RFSLinks;
use STR_ENC;
use CusAuth;

class referralController extends Controller
{
    
    public function __construct(){
        $this->middleware('cusauth');
    }

    public function generateReferralLink(Request $request){
        $ref = RFSLinks::create([
            'generated_link' => STR_ENC::exec('encrypt', (CusAuth::user()->user_id . (round(microtime(true) * 1000))) ),
            'user_id' =>  CusAuth::user()->user_id
        ]);

        if($request->ajax()){
            return response([
                "success" => true,
                "message" => json_encode($ref)
            ]);
        }
    }
}
