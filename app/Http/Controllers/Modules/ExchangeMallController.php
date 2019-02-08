<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CusAuth;
use App\Model\RohanUser;
use App\Model\EMChars;
use App\Model\GameCharacters;
use STR_ENC;

class ExchangeMallController extends Controller
{
    public function __construct(){
        $this->middleware('cusauth');
    }

    public function showExchangeMall(){
        //Default Char list
        $SellingChars = EMChars::orderByRaw("Char_exp desc")->get();
        $type_name = 'Characters';
        $up = RohanUser::where('user_id', CusAuth::user()->user_id)->get()[0]->points;
        return view('modules.exchangeMall', compact('SellingChars', 'type_name', 'up'));
    }

    public function buyChar(Request $request) {

        //Update Buyer's Points
        $c_up = RohanUser::where('user_id', CusAuth::user()->user_id)->get()[0]->points;
        $SellingChar = EMChars::where('Char_id', STR_ENC::exec('decrypt', $request->input('CH0')))->get();

        if($c_up <= $SellingChar[0]->Char_Price) {
            if($request->ajax()){
                return response([
                    "success" => true,
                    "message" => 'Not Enough RPs'
                ]);
            }
        }

        $Update_Buyer = RohanUser::where('user_id', CusAuth::user()->user_id)->update(array( 'points' => ($c_up - $SellingChar[0]->Char_Price) ));

        if(!$Update_Buyer) {
            if($request->ajax()){
                return response([
                    "success" => true,
                    "message" => 'Transaction Denied, Please Try Again'
                ]);
            }
        }

        //Updating seller points
        $Seller_Points = RohanUser::where('user_id', $SellingChar[0]->Char_Seller)->get()[0]->points;
        $UpdateSellerPoints = RohanUser::where('user_id', $SellingChar[0]->Char_Seller)->update(array( 'points' => ($Seller_Points + $SellingChar[0]->Char_Price) ));
        
        //Transfer Character

        if(!$UpdateSellerPoints){
            if($request->ajax()){
                return response([
                    "success" => true,
                    "message" => 'Transaction Denied, Please Try Again'
                ]);
            }
        }

        $Transfer = GameCharacters::where([
            ['id', '=', $SellingChar[0]->Char_id]
        ])->update(array(
            'user_id' => CusAuth::user()->user_id,
            'flag' => 0,
            'isSelling' => 0
        ));

        if(!$Transfer){
            if($request->ajax()){
                return response([
                    "success" => true,
                    "message" => 'Transaction Denied, Please Try Again'
                ]);
            }
        }

        //Removing from EM
        $rv = EMChars::where('Char_id', $SellingChar[0]->Char_id)->delete();

        if(!$rv) {
            if($request->ajax()){
                return response([
                    "success" => true,
                    "message" => 'Transaction Denied, Please Try Again'
                ]);
            }
        }

        if($request->ajax()){
            return response([
                "success" => true,
                "message" => 'Trade Successfully Executed!, Congratulations'
            ]);
        }
    }
    
}
