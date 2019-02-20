<?php

namespace App\Http\Controllers;

use App\Helpers\Nestable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;


use LaravelLocalization;
use Validator;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $category = CategoryProducts::get_cat();
        $nest = new Nestable($category);
        $cat = $nest->make_category();
        return view('product::categories.index',compact('cat'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
            $rules['category_name_'.$key ] = 'required';
        }

        $validation = Validator::make( $request->all(), $rules );
        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $category = new CategoryProducts();
        $category->category_image = $request->input('image');
        $category->category_status = $request->input('category_status');
        $category->parent_id = $request->input('parent_id');

        if(  $request->input( 'parent_id' ) == 0 ){
            $category->category_level = 0;
            $category->category_order = 0;
        }else{
            $parentCate = CategoryProducts::findOrFail( $request->input( 'parent_id' ) );
            $category->category_level = $parentCate->category_level + 1;
            $category->category_order = $parentCate->category_order + 1;
        }

        $category->save();

        if( $category ){
            $arrTrans = array();
            foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
                $arrTrans[] = new CategoryProductTrans(array(
                    'category_id' => $category->category_id ,
                    'category_name' => $request->input('category_name_'.$key ),
                    'category_slug' => Str::slug($request->input('category_name_'.$key )),
                    'category_description' => $request->input('category_description_'.$key ),
                    'language' => $key
                ));
            }

            $category->trans()->saveMany( $arrTrans );
        }


        if( $category ){
            return back()->with('status', trans('app.success') );
        }
        return back()->with('status', trans('app.insert_error') );
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($category_id)
    {

        $category = CategoryProducts::get_cat();
        $nest = new Nestable($category);
        $cat = $nest->make_category();
        $category = CategoryProducts::findOrFail( $category_id );
        return view('product::categories.edit',[ 'category' => $category, 'cat' => $cat ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $category_id )
    {
        foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
            $rules['category_name_'.$key ] = 'required';
        }

        $validation = Validator::make( $request->all(), $rules );
        if( $validation->fails() ){
            return back()
                ->withErrors($validation)
                ->withInput();
        }

        $category = CategoryProducts::findOrFail( $category_id );
        $category->category_image = $request->input('image');
        $category->category_status = $request->input('category_status');
        $category->parent_id = $request->input('parent_id');

        if(  $request->input( 'parent_id' ) == 0 ){
            $category->category_level = 0;
            $category->category_order = 0;
        }else{
            $parentCate = CategoryProducts::findOrFail( $request->input( 'parent_id' ) );
            $category->category_level = $parentCate->category_level + 1;
            $category->category_order = $parentCate->category_order + 1;
        }

        $category->save();

        if( $category ){

            foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
                CategoryProductTrans::where('language', $key)
                    ->where('category_id', $category->id)
                    ->update(array(
                        'category_id' => $category->id ,
                        'category_name' => $request->input('category_name_'.$key ),
                        'category_slug' => Str::slug($request->input('category_name_'.$key )),
                        'category_description' => $request->input('category_description_'.$key ),
                        'language' => $key
                    ));
            }

        }


        if( $category ){
            return back()->with('status', trans('app.success') );
        }
        return back()->with('status', trans('app.insert_error') );
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {

    }
}
