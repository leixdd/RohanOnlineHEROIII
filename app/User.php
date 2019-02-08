<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'rohan_user';
    protected $table = "TUser";
    public $timestamps = false;
    
    protected $fillable = [
        'login_id', 'login_pw', 'grade', 'reset', 'email', 'points', 'login_pw2'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'login_pw'
    ];
}
