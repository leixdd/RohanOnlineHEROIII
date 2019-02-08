<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EMChars extends Model
{
    //
    protected $connection = "rohan_trade";
    protected $table = "TExchangeCharacterList";
    public $timestamps = false;
    
    protected $fillable = [
        "Char_id", 
        "Char_Name", 
        "Char_type", 
        "Char_exp", 
        "Char_kill_count", 
        "Char_Killed_count", 
        "Char_level", 
        "Char_flag", 
        "Char_class", 
        "Char_Seller", 
        "Char_Price", 
        "Char_Description"
    ];
}
