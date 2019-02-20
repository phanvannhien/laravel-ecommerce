<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use Validator;
use LaravelLocalization;

use App\CategoryProductTrans;

class CategoryController extends Controller
{

    public function index(){
        $data = Category::withDepth()->get()->toTree();
        return view('admin.categories.index', compact('data'));
    }

    public function create(){

        return view('admin.categories.index');
    }

    public function store(Request $request){
        foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
            $rules['category_name_'.$key ] = 'required|string:max:254';
        }



        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $category = new Category();
        $category->image = $request->input('image');
        $category->status = $request->input('status');

        if( $request->input('parent_id') != 0 ){
            $category->parent_id = $request->input('parent_id');
        }

        if( $category->save() ){

            $arrTrans = array();

            foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
                $arrTrans[] = new CategoryProductTrans(array(
                    'category_id' => $category->category_id ,
                    'category_name' => $request->input('category_name_'.$key ),
                    'category_description' => $request->input('category_description_'.$key ),
                    'language_code' => $key,
                    'slug' => str_slug( $request->input('category_name_'.$key) )
                ));
            }

            $category->trans()->saveMany( $arrTrans );

            return redirect()->route( 'categories.edit', $category->id )->with('status', trans('app.success') );
        }
        return back()->with('status', trans('app.fail'));


    }

    public function edit( Request $request, $id ){
        $category = Category::findOrFail( $id );
        $data = Category::withDepth()->get()->toTree();
        return view('admin.categories.edit', compact('category','data'));

    }

    public function update(Request $request, $id){

        foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
            $rules['category_name_'.$key ] = 'required|string:max:254';
        }


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $category = Category::findOrFail( $id );
        $category->image = $request->input('image');
        $category->status = $request->input('status');

        if( $request->input('parent_id') != 0 ){
            $category->parent_id = $request->input('parent_id');
        }else{
            $category->makeRoot();
        }

        if( $category->save() ){

            foreach( LaravelLocalization::getSupportedLocales() as $key => $lang ){
                CategoryProductTrans::where('language_code', $key)
                    ->where('category_id', $category->id)
                    ->update(array(
                        'category_name' => $request->input('category_name_'.$key ),
                        'slug' => str_slug($request->input('category_name_'.$key )),
                        'category_description' => $request->input('category_description_'.$key ),
                    ));
            }


            return redirect()->route( 'categories.edit', $category->id )->with('status',  trans('app.success') );
        }
        return back()->with('status', trans('app.fail') );
    }

}
