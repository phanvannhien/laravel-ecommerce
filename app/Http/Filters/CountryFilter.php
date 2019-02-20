<?php
namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\Models\Countries;
use App\Filters\QueryFilters;


class CountryFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function value( $s ) {
        return $this->builder->where('value', 'LIKE', "%$s%");
    }


}