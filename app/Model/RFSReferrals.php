<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RFSReferrals extends Model
{
    protected $connection = "rohan_rfs";
    protected $table = "tbl_referrals";
    public $timestamps = true;
    
    protected $fillable = [
        'referrer_id','new_refer_id'
    ];
}
