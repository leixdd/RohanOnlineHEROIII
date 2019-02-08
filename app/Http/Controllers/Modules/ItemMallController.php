<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ItemMall;
use App\Model\RohanUser;
use App\Model\UserExItem;
use CusAuth;

class ItemMallController extends Controller
{
    public function __construct(){
        $this->middleware('cusauth');
    }

    public function showItemMall() {
        $type_name = "All Items";
        $up = RohanUser::where('user_id', CusAuth::user()->user_id)->get()[0]->points;
        $items = ItemMall::where('Item_Visible', 1)->get();
        return view('modules.itemMall', compact('items', 'type_name', 'up'));
    }

    public function showItem($type) {
        
        $up = RohanUser::where('user_id', CusAuth::user()->user_id)->get()[0]->points;
        $type_name = str_replace("x", " ", explode("_", $type)[1]);
        $items = ItemMall::where([

            ['Item_Category', '=', explode("_", $type)[0]],
            ['Item_Visible', '=', '1']
            
            ])->get();
        return view('modules.itemMall', compact('items', 'type_name', 'up'));
    }

    public function purchaseItem(Request $request){

        $item = ItemMall::where('id', $request->input('item_id'))->get();
        $user_points = RohanUser::where('user_id', CusAuth::user()->user_id)->get();
        $q = $request->input("quantity");

        //TODO : ($item[0]->Item_Price * User Quantity)
        if(($item[0]->Item_Price * $q) <= $user_points[0]->points) {

            //Execute Purchase

            $exItem = '';

            if($item[0]->Item_Pack == 1) {

                for($i = 0; $i < $q; $i++) {
                    $exItem = UserExItem::create([
                        "type" => $item[0]->Item_Id, 
                        "attr" => 0x00, 
                        "stack" => $item[0]->Item_Quantity, 
                        "rank" => 0, 
                        "user_id" => CusAuth::user()->user_id, 
                        "date" => "2018", 
                        "equip_level" => 0, 
                        "equip_strength" => 0, 
                        "equip_dexterity" => 0, 
                        "equip_intelligence" =>0
                    ]);
                }
            }else{
                $exItem = UserExItem::create([
                    "type" => $item[0]->Item_Id, 
                    "attr" => 0x00, 
                    "stack" => ($item[0]->Item_Quantity * $q), 
                    "rank" => 0, 
                    "user_id" => CusAuth::user()->user_id, 
                    "date" => "2018", 
                    "equip_level" => 0, 
                    "equip_strength" => 0, 
                    "equip_dexterity" => 0, 
                    "equip_intelligence" =>0
                ]);
    
               
            }

            if($exItem) {
                RohanUser::where("user_id", CusAuth::user()->user_id)
                ->update(array(
                    "points" => ($user_points[0]->points - ($item[0]->Item_Price * $q))
                ));
            }

            if($request->ajax()){
                return response([
                    "success" => true,
                    "message" => 'Purchased Successfully'
                ]);
            }

        }else{
            return response([
                "success" => false,
                "message" => 'Not enough RPs'
            ]);
        }

    }
}
