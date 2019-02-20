<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Filters\ProductFilter;
use App\Product;
use App\ProductGallery;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Cache;

class ProductController extends Controller
{



    public function index( Request $request, ProductFilter $filter ){
        $categories = Category::withDepth()->get()->toTree();
        $data = Product::filter($filter)->orderBy('title')->paginate();
        return view('admin.product.index', compact('data','categories'));
    }

    public function create(){
        $cats =  Category::withDepth()->get()->toTree();
        return view('admin.product.create', compact('cats'));
    }

    public function store(Request $request){
        $rules = [
            'title' => 'required|string:max:254',
            'price' => 'required|numeric',
        ];

        if( $request->has('sale_price') && $request->input('sale_price') != '' ){
            $rules['sale_price'] = 'numeric';
        }


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $product  = new Product();
        $product->title = $request->input('title');
        $product->slug = str_slug($request->input('title'));
        $product->price = $request->input('price');
        $product->sale_price = $request->input('sale_price');
        $product->link = $request->input('link');
        $product->image = $request->input('image');
        if( $request->has('is_new') )
            $product->is_new = $request->input('is_new');

        if( $request->has('is_sale_total') )
            $product->is_sale_total = $request->input('is_sale_total');


        $product->sort_description = $request->input('sort_description');
        $arr = [];
        if( $request->has('galleries') ){
            foreach ( $request->get('galleries') as $img){
                array_push($arr, ['image_url' => $img] );
            }
        }


        if( $product->save() ){
            $product->categories()->attach( $request->input('cat_id') );
            if( count( $arr ) ){
                $product->galleries()->createMany($arr);
            }

            return redirect()->route( 'product.edit', $product->id )->with('status','Tạo thành công');
        }
        return back()->with('status','Tạo lỗi');


    }

    public function edit( Request $request, $id ){
        $product = Product::findOrFail( $id );

        $cats =  Category::withDepth()->get()->toTree();
        return view('admin.product.edit', compact('product','cats'));

    }

    public function update(Request $request, $id){

//        dd( array_values($request->input('cat_id')) );

        $rules = [
            'title' => 'required|string:max:254',
            'price' => 'required|numeric',
        ];

        if( $request->has('sale_price') && $request->input('sale_price') != '' ){
            $rules['sale_price'] = 'numeric';
        }

        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $product  = Product::findOrFail($id);
        $product->title = $request->input('title');
        $product->slug = str_slug($request->input('title'));
        $product->price = $request->input('price');
        $product->sale_price = $request->input('sale_price');
        $product->link = $request->input('link');
        $product->image = $request->input('image');
        if( $request->has('is_new') )
            $product->is_new = $request->input('is_new');
        else{
            $product->is_new = 0;
        }


        if( $request->has('is_sale_total') )
            $product->is_sale_total = $request->input('is_sale_total');
        else{
            $product->is_sale_total = 0;
        }

        $product->sort_description = $request->input('sort_description');

        $arr = [];
        if( $request->has('galleries') ){
            foreach ( $request->get('galleries') as $img){
                array_push($arr, ['image_url' => $img] );
            }
        }

        if( $product->save() ){
            $product->categories()->detach();
            $product->categories()->attach( $request->input('cat_id') );

            if( count( $arr ) ){
                $product->galleries()->delete();
                $product->galleries()->createMany($arr);
            }

            return redirect()->route( 'product.edit', $product->id )->with('status','Tạo thành công');
        }
        return back()->with('status','Tạo lỗi');
    }

    public function remove(Request $request){
        if( $request->ajax() && $request->isMethod('post')){
            $id = $request->input('id');
            if( is_array( $id ) ){
                Product::destroy($id);
            }else{
                Product::destroy($id);
            }

            Cache::flush();

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
