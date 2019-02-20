<?php

namespace App;

use App\Filters\Filterable;
use App\Models\Type;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


use App\Models\Cities;
use App\Models\District;
use App\Models\Wards;
use App\Models\Comment;

class Product extends Model
{
    use Sluggable, SluggableScopeHelpers;
    use Filterable;

    protected $table = 'products';

    public $fillable = [
        'slug',
        'title',
        'price',
        'sale_price',
        'image',
        'link',
        'is_new',
        'sort_description',
        'description',
        'matp',
        'maqh',
        'xaid',
        'user_id',
        'lat',
        'lng',
        'vr',
        'address',
        'investor_id',
        'area',
        'legal',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function getThumbnail(){
        if( $this->image == '' ){
            return url('admin/dist/img/default-50x50.gif');
        }
        return $this->image;
    }

    public function getPrice(){
        if( $this->sale_price != 0 || $this->sale_price != '' ){
            $discount = round(($this->price-$this->sale_price)/$this->price*100);
            $html = '<strong class="price">'.number_format($this->sale_price).'đ</strong>
                <span class="regular-price">'.number_format($this->price).'đ</span>
                <span class="dis">'.-$discount.'%</span>';
        }
        else{
            $html = '<strong class="price">'.number_format($this->price).'đ</strong>';
        }
        return $html;
    }

    public function getPriceDiscount(){


        $price_dis = round($this->price*70/100);
        $sale_price = round($this->price - $price_dis,-3);
        $html = '<strong class="price">'.number_format($sale_price).'đ</strong>
            <span class="regular-price">'.number_format($this->price).'đ</span>
            <span class="dis">-70%</span>';
        return $html;
    }

    public function getCategories(){
        $html = '';
        foreach ( $this->categories as $cat ){
           $html .= '<a href="'.route('categories.edit', $cat->id ).'">'.$cat->category_name.'</a>, ';
        }
        return $html;
    }

    public function getCategoriesFront(){
        $html = '';
        $arr = $this->categories->pluck('category_name')->toArray();


        return implode(', ', $arr);
    }

    public function getTypesFront(){
        $html = '';
        foreach ( $this->types as $type ){
            //$html .= '<a href="'.route('type.product', $type->slug ).'">'.$type->type_name.'</a>, ';
        }
        return $html;
    }

    public function getCity(){
        return $this->belongsTo( Cities::class, 'matp','matp' )
            ->select('name')->first();
    }

    public function getDistrict(){
        return $this->belongsTo( District::class, 'maqh','maqh' )
            ->select('name')
            ->first();
    }

    public function getWard(){
        return $this->belongsTo( Wards::class, 'xaid','xaid' )
            ->select('name')
            ->first();
    }

    public function getFullAddress(){
        return $this->address.', '.$this->getWard()->name.', '.$this->getDistrict()->name.', '.$this->getCity()->name;
    }


    // Relations

    public function user(){
        return $this->belongsTo( User::class );
    }


    public function categories(){
        return $this->belongsToMany( Category::class );
    }

    public function galleries(){
        return $this->hasMany( ProductGallery::class );
    }

    public function types(){
        return $this->belongsToMany( Type::class );
    }


    public function loves(){
        return $this->belongsToMany( User::class );
    }

    public function comments(){
        return $this->hasMany( Comment::class );
    }
}

