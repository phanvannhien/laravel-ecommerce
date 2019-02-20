<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use Filterable;
    protected $connection = 'mysql';
    protected $table = 'countries';

    public $timestamps = false;


    public function cities(){
        return $this->hasMany( Cities::class, 'country_code' );
    }
}
