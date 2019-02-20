<?php

namespace App\Utils;

class Category{


    public static function renderAdminHtml( $cats, $edit = 'categories.edit', $delete = 'categories.destroy', $class = 'dd-list-cat'){
        $html = "<ul class=\"".$class."\" >";

        foreach($cats as $cat) {

            $trans = $cat->get_trans();

            $edit_href = route( $edit,$cat->id);
            $delete_href = route($delete,$cat->id);
            $html.= '<li class="dd-item" data-id="'.$cat->id.'" >
                <div class="dd3-content clearfix">
                    <img width="30" src="'.$cat->getImage().'" alt="">
                    <div class="content-left">
                        <p class="pull-right">
                            <a class="btn btn-sm btn-primary" id="'.$cat->id.'" href="'.$edit_href.'" ><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger" id="'.$cat->id.'" href="'.$delete_href.'"><i class="fa fa-trash"></i></a>
                        </p>
                        <p id="label_show'.$cat->id.'">'.$trans->category_name.'</p>
                        
                    </div>
                </div>';

            if(  $cat->children ) {
                $html .= self::renderAdminHtml($cat->children, $edit, $delete);
            }
            $html .= "</li>";
        }
        $html .= "</ul>";
        return $html;
    }



    public static function renderSelect( $cats, $selected = '' ){

        $html = "";
        foreach($cats as $cat) {
            $trans = $cat->get_trans();
            $att = ( $cat->id == $selected ) ? 'selected' : '';
            $spe = '';
            for( $i = 1; $i <= $cat->depth; $i++ ){
                $spe .= '&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $html.= '<option '.$att.' value="'.$cat->id.'">'.$spe.$trans->category_name.'</option>';
            if( $cat->children ) {
                $html .= self::renderSelect($cat->children, $selected );
            }
        }
        return $html;

    }


    public static function renderSelectMultiple( $cats, $selected = array() ){

        $html = "";
        foreach($cats as $cat) {
            $trans = $cat->get_trans();
            $att = ( in_array($cat->id, $selected )) ? 'selected' : '';
            $spe = '';
            for( $i = 1; $i <= $cat->depth; $i++ ){
                $spe .= '&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $html.= '<option '.$att.' value="'.$cat->id.'">'.$spe.$trans->category_name.'</option>';
            if( $cat->children ) {
                $html .= self::renderSelect($cat->children, $selected );
            }
        }
        return $html;

    }


    public static function renderCheckbox( $cats, $selected = array()){

        $html = "";
        foreach($cats as $cat) {
            $trans = $cat->get_trans();
            $att = ( in_array($cat->id, $selected )) ? 'checked' : '';
            $spe = '&nbsp;';
            for( $i = 1; $i <= $cat->depth; $i++ ){
                $spe .= '&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $html.= '<p><input name="cat_id[]" type="checkbox" class="i-checks" '.$att.' value="'.$cat->id.'">'.$spe.$trans->category_name.'</p>';
            if( $cat->children ) {
                $html .= self::renderCheckbox($cat->children, $selected );
            }
        }
        return $html;

    }


}