<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVouchers extends Model
{


    public function user(){
        return $this->belongsTo( User::class,'user_id', 'id' );
    }

    public function voucher(){
        return $this->belongsTo( Voucher::class,'voucher_id', 'id' );
    }

}
