<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use App\User;
use App\Helpers\Timer;

class Comment extends Model
{
    protected $fillable = [
        'body',
        'user_id',
        'product_id',
        'parent_id',
        'status',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];


    public function getCreatedAtAttribute($value)
    {
       return Timer::time_elapsed_string($value);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')->select('avatar','id','user_name');
    }

    public function children() {
        return $this->hasMany( \App\Models\Comment::class, 'parent_id', 'id');
    }
}
