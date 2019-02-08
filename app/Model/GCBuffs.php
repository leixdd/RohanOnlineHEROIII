<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GCBuffs extends Model
{
    protected $connection = "rohan_game";
    protected $table = "TSkillAffect";
    public $timestamps = false;

    protected $fillable = [
        'char_id',
        'kind',
        'level',
        'affect_time',
        'event_time',
    ];
}
