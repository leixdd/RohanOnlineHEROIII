<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserExItem extends Model
{
    protected $connection = "rohan_mall";
    protected $table = "TItem";
    public $timestamps = false;

    protected $fillable = [
        "type", 
        "attr", 
        "stack", 
        "rank", 
        "user_id", 
        "date", 
        "equip_level", 
        "equip_strength", 
        "equip_dexterity", 
        "equip_intelligence"
    ];
}
