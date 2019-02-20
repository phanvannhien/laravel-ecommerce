<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nestable\NestableTrait;


class CategoryProducts extends Model
{


    protected $table = 'category_product';
    protected $fillable = [];

    public function trans(){
        return $this->hasMany( CategoryProductTrans::class, 'category_id', 'id' );
    }

    public static function get_cat(){
        $cat = self::join('category_product_trans','category_product_trans.category_id','=','category_product.id')
            ->where( 'category_product_trans.language', app()->getLocale())
            ->select('category_product.id','parent_id','category_name as name','category_slug as slug','category_image as image','category_level')
            ->get();

        $arrOut = [];
        foreach ( $cat as $c ){
            $arrOut[] = [
                'id' => $c->id,
                'parent_id' => $c->parent_id,
                'slug' => $c->slug,
                'category_level' => $c->category_level,
                'name' => $c->name,
                'image' => $c->image,
                'edit' => route('categories.edit', $c->id),
                'delete' => route('categories.destroy', $c->id),
                'view' => '#'
            ];
        }

        return $arrOut;
    }
}
