<?php
namespace App\Http\Controllers\Admin;

use App\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use DB;

use App\Http\Filters\BlogFilter;

// Models
use App\Models\Blog;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index( Request $request, BlogFilter $filter )
    {
        $categories = BlogCategory::withDepth()->get()->toTree();
        $data = Blog::filter($filter)->paginate(20);
        return view('admin.blog.index', compact('data','categories') );

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $cats =  BlogCategory::withDepth()->get()->toTree();
        return view('admin.blog.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {


        $validation = Validator::make( $request->all(),[
            'blog_title' => 'required',
            'blog_excerpt' => 'required',
            'blog_content' => 'required',
            'blog_thumbnail' => 'required',
        ]);

        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $post = new Blog();
        $post->blog_title = $request->input('blog_title');
        $post->blog_excerpt = $request->input('blog_excerpt');
        $post->blog_content = $request->input('blog_content');
        $post->blog_thumbnail = $request->input('blog_thumbnail');
        $post->blog_status = $request->input('blog_status');
        $post->blog_type = 'post';


        try{
            DB::beginTransaction();
            if( $post->save() ){
                //save categories
                $post->categories()->attach( $request->input('cat_id') );

                DB::commit();
                return redirect()->route('blog.edit', $post->id )
                    ->with('status', trans('global.success') );
            }

        }catch( Exception $e ){
            DB::rollBack();
        }

        return back()->with('status', trans('app.insert_error') );

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        $cats =  BlogCategory::withDepth()->get()->toTree();
        return view('admin.blog.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $cats =  BlogCategory::withDepth()->get()->toTree();
        $post = Blog::findOrFail( $id );
        return view('admin.blog.edit', compact('post','cats'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make( $request->all(),[
            'blog_title' => 'required',
            'blog_excerpt' => 'required',
            'blog_content' => 'required',
            'blog_thumbnail' => 'required',
        ]);

        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $post = Blog::findOrFail($id);
        $post->blog_title = $request->input('blog_title');
        $post->blog_excerpt = $request->input('blog_excerpt');
        $post->blog_content = $request->input('blog_content');
        $post->blog_thumbnail = $request->input('blog_thumbnail');
        $post->blog_status = $request->input('blog_status');
        $post->blog_type = 'post';
        $post->slug = null;

        try{
            DB::beginTransaction();
            if( $post->save() ){
                //save categories
                $post->categories()->detach();
                $post->categories()->attach( $request->input('cat_id') );

                DB::commit();
                return redirect()->route('blog.edit', $post->id )
                    ->with('status', trans('global.success') );
            }

        }catch( Exception $e ){
            DB::rollBack();
        }

        return back()->with('status', trans('app.fail') );
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
