<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    public function getImage(){
        if( $this->image == '' ){
            return url('admin/dist/img/default-50x50.gif');
        }
        return $this->image;
    }
}
