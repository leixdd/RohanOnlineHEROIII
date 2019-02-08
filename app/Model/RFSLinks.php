<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RFSLinks extends Model
{
    protected $connection = "rohan_rfs";
    protected $table = "tbl_links";
    public $timestamps = true;
    
    protected $fillable = [
        'link_id',
        'generated_link',
        'user_id',
    ];
}
