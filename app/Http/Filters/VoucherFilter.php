<?php
namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\User;
use App\Filters\QueryFilters;


class VoucherFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function program( $s ) {
        return $this->builder->where('program', $s);
    }

    public function voucher( $s ) {
        return $this->builder->where('voucher', $s);
    }

    public function is_use( $s ) {
        return $this->builder->where('is_use', $s);
    }

    public function created_at( $s ) {
        return $this->builder->where('created_at', '>=', $s);
    }



}