<?php
namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\Product;
use App\Filters\QueryFilters;


class ProductFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function title( $s ) {
        return $this->builder->where('title', 'LIKE', "%$s%");
    }

    public function category( $s ) {
        return $this->builder->whereHas('categories', function($query) use ($s){
            return $query->where('category_id', $s );
        });
    }

    public function user_id( $s ) {
        return $this->builder->where('user_id', $s);
    }


    public function matp( $s ) {
        return $this->builder->where('matp', $s);
    }

    public function maqh( $s ) {
        return $this->builder->where('maqh', $s);
    }

    public function price_range( $s ) {

        $arr = explode(',', $s);

        if( $arr[0] )
            $this->builder->where('price','>=', $arr[0]);
        if( $arr[1] )
            $this->builder->where('price','<=', $arr[1]);
        return $this;
    }

}