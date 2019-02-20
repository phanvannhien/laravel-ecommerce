<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $fillable = [
        'message',
        'user_id',
        'conversation_id'
    ];
}
