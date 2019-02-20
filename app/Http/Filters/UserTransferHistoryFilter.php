<?php
namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\Filters\QueryFilters;


class UserTransferHistoryFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function status( $s ) {
        return $this->builder->where('status', $s);
    }

    public function to_user_id( $s ) {
        return $this->builder->where('to_user_id', $s);
    }




}