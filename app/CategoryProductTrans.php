<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProductTrans extends Model
{
    protected $table = 'category_trans';

    public $fillable = [
        'language_code',
        'category_id',
        'category_name',
        'category_description',
        'slug',
    ];
}
