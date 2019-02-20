<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    CONST PENDING = 0;
    CONST ACCEPTED = 1;
    CONST DECLINED = 2;
    CONST BLOCKED = 3;

    protected  $table = 'contacts';

    public $fillable = [
        'user_id',
        'contact_id',
        'status', //
        'action_user_id',
    ];

  



}
