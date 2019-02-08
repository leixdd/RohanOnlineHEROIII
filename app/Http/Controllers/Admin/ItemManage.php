<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ItemMall;

class ItemManage extends Controller
{
    
    public function __construct(){
        $this->middleware('admin');
    }

    public function renderIM(){
        
        $items = ItemMall::where('Item_Visible', 1)->get();
        return view("modules.adminPanel", compact('items'));
    }

    public function renderAddItem(){
        return view("modules.adminAddItem");
    }

    public function editItem($id){
        $item = ItemMall::where([
            ['Item_Visible', '=', 1],
            ['id' , '=', $id]
        ])->get()[0];
        
        //var_dump($item);
        return view("modules.adminEditItem", compact('item'));
    }

    public function searchItem(Request $request) {
        $items = ItemMall::where([
            ['Item_Visible', '=', 1],
            ['Item_Id' , 'like', '%'.$request->input('id').'%']
        ])->get();

        return view("modules.adminPanel", compact('items'));
    }

    public function saveIM(Request $request){

        $suc = ItemMall::create([
            "Item_Category" => $request->input('item_category'),
            "Item_Pack" => $request->input('item_packaging'), 
            "Item_Image" => $request->input('item_image'), 
            "Item_Id" => $request->input('item_id'), 
            "Item_Name" => $request->input('item_name'), 
            "Item_Description" => $request->input('item_description'), 
            "Item_Quantity" => $request->input('item_quantity'), 
            "Item_Price" => $request->input('item_price'), 
            "Item_Visible" => 1
        ]);
               
        
        if($suc) {
            return response([
                "success" => true
            ]);
        }else {
            return response([
                "success" => false
            ]);
        }
        
    }
 
    public function updateIM(Request $request){

        if(ItemMall::where("Item_Id", $request->input('item_id'))->count() != 0) {
            ItemMall::where("Item_Id", $request->input('item_id'))->update(array(
                "Item_Category" => $request->input('item_category'), 
                "Item_Pack" => $request->input('item_packaging'),
                "Item_Image" => $request->input('item_image'),
                "Item_Name" => $request->input('item_name'), 
                "Item_Description" => $request->input('item_description'), 
                "Item_Quantity" => $request->input('item_quantity'), 
                "Item_Price" => $request->input('item_price'), 
                "Item_Visible" => 1
            ));
    
            
            return response([
                "success" => true
            ]);
    

        }else{

            return response([
                "success" => false
            ]);
        
        }
    }

}
