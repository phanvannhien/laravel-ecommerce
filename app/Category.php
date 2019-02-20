<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

use App\CategoryProductTrans;
use App\Traits\TranslateAble;



class Category extends Model
{
    use NodeTrait, TranslateAble;

    protected $table = 'categories';

    public $fillable = [
        'slug',
        'image',
        'status',
        'parent_id',
    ];


    public function getImage(){
        if( $this->image == '' ){
            return url('admin/dist/img/default-50x50.gif');
        }
        return $this->image;
    }

    public function products(){
        return $this->belongsToMany( Product::class);
    }

    public function trans(){
        return $this->hasMany( CategoryProductTrans::class, 'category_id', 'id' );
    }

}
