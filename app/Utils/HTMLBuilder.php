<?php

namespace App\Utils;

class HTMLBuilder{

    public static function renderFlatCheckbox( $data, $name, $selected = array()){

        $html = "";
        foreach($data as $cat) {
            $att = ( in_array($cat->id, $selected )) ? 'checked' : '';
            $html.= '<label><input name=".$name." type="checkbox" class="i-checks" '.$att.' value="'.$cat->id.'">'.$cat->title.'</label>';
        }
        return $html;

    }

}