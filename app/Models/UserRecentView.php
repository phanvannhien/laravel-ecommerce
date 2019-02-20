<?php

namespace App\Models;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class UserRecentView extends Model
{

    protected $table = 'user_recent_view';
    public $fillable = [
        'user_id',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo( Product::class );
    }
}
