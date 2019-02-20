<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use Filterable;


    public $fillable = [
        'program',
        'voucher',
        'voucher_value',
    ];

    public function getStatus(){
        if( $this->is_use ){
            return '<span class="label label-danger">Đã trúng</span>';
        }
        return '<span class="label label-danger">Chưa trúng</span>';
    }
    //
}
