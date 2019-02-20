<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //

    protected $guard = 'admin';
    protected $table = 'admins';
    protected $fillable = [
        'first_name', 'last_name', 'user_name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


}
