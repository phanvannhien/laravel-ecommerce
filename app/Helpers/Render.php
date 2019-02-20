<?php

namespace App\Helpers;

class Render{

    public static function renderPost( $posts, $type = 'post_list' ){
        return view('blocks.'.$type, compact('posts'))->render();
    }

}