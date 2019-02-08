<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GameCharLogin extends Model
{
    protected $connection = "rohan_game";
    protected $table = "TCharacterLogin";
    public $timestamps = false;

    protected $fillable = [];
}
