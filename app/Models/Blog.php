<?php

namespace App\Models;

use App\BlogCategory;
use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Blog extends Model
{
    use Sluggable, SluggableScopeHelpers;
    use Filterable;

    protected $table = 'blogs';
    protected $fillable = [];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'blog_title'
            ]
        ];
    }

    public function categories(){
        return $this->belongsToMany( BlogCategory::class );
    }




}
