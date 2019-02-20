<?php
namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\User;
use App\Filters\QueryFilters;


class WalletFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }



    public function user_id( $s ) {
        return $this->builder->where('user_id', $s);
    }

    public function service( $s ) {
        return $this->builder->where('service', $s);
    }

    public function status( $s ) {
        return $this->builder->where('status', $s);
    }




}