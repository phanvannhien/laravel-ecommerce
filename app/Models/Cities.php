<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cities';
    protected $primaryKey = 'matp';

    public $timestamps = false;

    public $fillable = [
        'matp',
        'name',
        'type',
    ];

//    public function country(){
//        return $this->belongsTo( Countries::class, 'country_code' );
//    }
}
