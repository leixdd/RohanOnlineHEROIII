<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserDisconnect extends Model
{
    protected $connection = 'rohan_user';
    protected $table = "TDisconnect";
    public $timestamps = false;
    
    protected $fillable = [
        "user_id", "server_id", "char_id"
    ];
}
