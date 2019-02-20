<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Continents extends Model
{
    protected $connection = 'mysql';
    protected $table = 'continents';

    public $timestamps = false;
    protected $primaryKey = 'code';
    protected $fillable = ['code','name'];

}
