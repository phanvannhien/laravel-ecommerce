<?php
namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\Filters\QueryFilters;


class UserTransactionFilter extends QueryFilters
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

    public function user_action( $s ) {
        return $this->builder->where('user_action', $s);
    }

    public function user_id( $s ) {
        return $this->builder->where('user_id', $s);
    }

    public function id( $s ) {
        return $this->builder->where('id', $s);
    }


    public function transaction_id( $s ) {
        return $this->builder->where('transaction_id', $s);
    }



}