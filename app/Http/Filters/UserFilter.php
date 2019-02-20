<?php
namespace App\Http\Filters;

use Illuminate\Http\Request;
use App\User;
use App\Filters\QueryFilters;


class UserFilter extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function email( $s ) {
        return $this->builder->where('email', 'LIKE', "%$s%");
    }

    public function user_name( $s ) {
        return $this->builder->where('user_name', 'LIKE', "%$s%");
    }

    public function full_name( $s ) {
        return $this->builder->where('full_name', 'LIKE', "%$s%");
    }

    public function phone( $s ) {
        return $this->builder->where('phone', 'LIKE', "%$s%");
    }

    public function user_id( $s ) {
        return $this->builder->where('user_id', $s);
    }

    public function user_reference( $s ) {
        return $this->builder->where('user_reference', $s);
    }

    public function parent_id( $s ) {
        return $this->builder->where('parent_id', $s);
    }

    public function id( $s ) {

        return $this->builder->whereIn('id', $s);

    }

    public function status( $s ) {
        return $this->builder->where('status', $s);
    }

    public function voucher_date( $s ) {

        return $this->builder->where('voucher_date', 'LIKE', "%$s%");
    }

    public function gift_date1( $s ) {
        return $this->builder->where('gift_date1', 'LIKE', "%$s%");
    }

    public function utm( $s ){

        if( $s != '' ){
            if( $s == 'utm_voucher' ){
                return $this->builder->where('utm_voucher', '!=','');
            }

            if( $s == 'utm_mom_kid' ){
                return $this->builder->where('utm_mom_kid', '!=','');
            }
        }

        
    }


     public function program( $s ){
        if( $s != '' ){
            if( $s == 'voucher' ){
                return $this->builder->where('voucher_id', '!=','');
            }

            if( $s == 'mom_kid' ){
                return $this->builder->where('gift_id1', '!=','');
            }
        }
    }

}