<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'types';

    public $fillable = [
        'type_name',
        'type_slug',
    ];




}
