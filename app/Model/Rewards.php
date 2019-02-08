<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    protected $connection = "rohan_rfs";
    protected $table = "tbl_rewards";
    public $timestamps = true;
    
    protected $fillable = [
        'reward_name',
        'reward_desc',
        'reward_trigger',
    ];
}
