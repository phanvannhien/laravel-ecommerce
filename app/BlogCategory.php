<?php

namespace App;

use App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Kalnoy\Nestedset\NodeTrait;

class BlogCategory extends Model
{
    use NodeTrait;


    protected $fillable = [];

    protected $table = 'blog_categories';

    public function blogs(){
        return $this->hasMany( Blog::class);
    }


    public function getImage(){
        if( $this->image == '' ){
            return url('admin/dist/img/default-50x50.gif');
        }
        return $this->image;
    }


}
