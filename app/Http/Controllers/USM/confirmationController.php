<?php

namespace App\Http\Controllers\USM;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CusAuth;
use App\Model\RFSConfirmations;

class confirmationController extends Controller
{
    public function __construct() {
        if(!CusAuth::user()) {
            return redirect()->route('login');
        }
    }

    public function checkCode() {
        return view('modules.checkCode');
    }

    public function confirmCode(Request $request) {

        
        if($request->input('confirmcode') !== RFSConfirmations::where('user_id', CusAuth::user()->user_id)->get()[0]->confirmation_code) {
            return redirect('/User/confirmation')->with('errorNE', 'Invalid Confirmation Code')->withInput();
        }

        RFSConfirmations::where('user_id', CusAuth::user()->user_id)->update(array(
            'isConfirm' => 1
        ));

        return redirect('/User/profile');
    }
}
