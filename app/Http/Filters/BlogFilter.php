<?php
namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\Filters\QueryFilters;




class BlogFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function post_title( $s ) {
        return $this->builder->where('post_title', 'LIKE', "%$s%");

    }

    public function category( $s ) {
        return $this->builder->whereHas('categories', function($query) use ($s){
            return $query->where('blog_category_id', $s );
        });
    }


}