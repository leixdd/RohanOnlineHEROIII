<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GCStatus extends Model
{
    protected $connection = "rohan_game";
    protected $table = "TCharacterStatus";
    public $timestamps = false;

    protected $fillable = [];
}
