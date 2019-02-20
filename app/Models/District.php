<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $connection = 'mysql';
    protected $table = 'district';
    protected $primaryKey = 'maqh';

    public $timestamps = false;


    public $fillable = [
        'maqh',
        'name',
        'type',
        'matp',
    ];

    public function city(){
        return $this->belongsTo( Cities::class, 'matp' );
    }
}
