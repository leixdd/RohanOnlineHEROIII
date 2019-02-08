<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminCMS extends Model
{
    protected $connection = "rohan_cms";
    protected $table = "tbl_post";

    protected $fillable = ["post_title", "post_content"];
}
