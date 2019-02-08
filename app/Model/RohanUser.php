<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RohanUser extends Authenticatable
{
    protected $connection = 'rohan_user';
    protected $table = "TUser";
    public $timestamps = false;
    
    protected $fillable = [
        'login_id', 'login_pw', 'grade', 'reset', 'email', 'points', 'login_pw2'
    ];

}
