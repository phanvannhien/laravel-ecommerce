<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    public $fillable = [
        'code',
        'title',
        'description',
        'status',
    ];

    public function getStatus(){
        if( $this->status ){
            return '<span class="label label-success">'.trans('app.activate').'</span>';
        }
        return '<span class="label label-danger">'.trans('app.deactivate').'</span>';
    }
}
