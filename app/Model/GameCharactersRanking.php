<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GameCharactersRanking extends Model
{
    protected $connection = "rohan_game";
    protected $table = "TCharacter";
    public $timestamps = false;

    protected $fillable = [];
}
