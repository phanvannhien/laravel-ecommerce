<?php
namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Validator;
use Auth;

use App\Http\Filters\BlogFilter;

// Models
use App\Models\Blog;


class BlogCategoryController extends Controller
{
    public function index(){
        $data = BlogCategory::withDepth()->get()->toTree();
        return view('admin.blogcategories.index', compact('data'));
    }


    public function create(){
        return view('admin.blogcategories.index');
    }


    public function store(Request $request){
        $rules = [
            'category_name' => 'required|string:max:254'
        ];

        if( $request->has('slug') && $request->input('slug') != ''  ){
            $rules = [
                'slug' => 'required|string:max:254',
            ];
        }


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $category = new BlogCategory();
        $category->category_name = $request->input('category_name');

        if( $request->has('slug') && $request->input('slug') != '' ){
            $category->slug = $request->input('slug');
        }else{
            $category->slug = str_slug($request->input('category_name'));
        }

        $category->image = $request->input('image');
        $category->status = $request->input('status');

        if( $request->input('parent_id') != 0 ){
            $category->parent_id = $request->input('parent_id');
        }

        if( $category->save() ){
            return redirect()->route( 'blog-category.edit', $category->id )->with('status', trans('app.success'));
        }
        return back()->with('status', trans('app.fail'));


    }

    public function edit( Request $request, $id ){
        $category = BlogCategory::findOrFail( $id );
        $data = BlogCategory::withDepth()->get()->toTree();
        return view('admin.blogcategories.edit', compact('category','data'));

    }

}