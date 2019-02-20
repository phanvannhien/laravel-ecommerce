<?php
namespace App\Traits;

trait TranslateAble{

    public function get_trans( ){
        return $this->trans()->where( 'language_code', app()->getLocale() )->first();
    }

    public function get_trans_by( $lang ){
        return $this->trans()->where( 'language_code', $lang )->first();
    }
}