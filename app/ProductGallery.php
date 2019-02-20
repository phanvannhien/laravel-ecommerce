<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    //

    protected $table = 'product_galleries';

    public $fillable = [
        'product_id',
        'image_url',
    ];
}
