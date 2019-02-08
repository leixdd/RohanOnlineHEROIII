<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItemMall extends Model
{
    protected $connection = "rohan_mall";
    protected $table = "TItemList";
    public $timestamps = false;

    protected $fillable = [
        "Item_Category",
        "Item_Pack",
        "Item_Image", 
        "Item_Id", 
        "Item_Name", 
        "Item_Description", 
        "Item_Quantity", 
        "Item_Price", 
        "Item_Visible"
    ];
    
}
