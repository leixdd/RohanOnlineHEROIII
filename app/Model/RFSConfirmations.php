<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RFSConfirmations extends Model
{
    protected $connection = "rohan_rfs";
    protected $table = "tbl_confirmations";
    public $timestamps = true;
    
    protected $fillable = [
        'isConfirm','confirmation_code', 'user_id'
    ];
}
