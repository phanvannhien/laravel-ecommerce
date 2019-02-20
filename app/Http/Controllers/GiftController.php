<?php

namespace App\Http\Controllers;

use App\Category;
use App\Gift;
use Illuminate\Http\Request;
use Validator;


class GiftController extends Controller
{
    public function index(){
        $data = Gift::orderBy('title')->paginate();
        return view('admin.gift.index', compact('data'));
    }

    public function create(){
        return view('admin.gift.create');
    }

    public function store(Request $request){
        $rules = [
            'title' => 'required|string:max:254',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $gift  = new Gift();
        $gift->title = $request->input('title');
        $gift->image = $request->input('image');

        if( $gift->save() ){
            return redirect()->route( 'gift.edit', $gift->id )->with('status','Tạo thành công');
        }
        return back()->with('status','Tạo lỗi');

    }

    public function edit( Request $request, $id ){
        $gift = Gift::findOrFail( $id );
        return view('admin.gift.edit', compact('gift'));

    }

    public function update(Request $request, $id){

        $rules = [
            'title' => 'required|string:max:254',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $gift = Gift::findOrFail($id);
        $gift->title = $request->input('title');
        $gift->image = $request->input('image');

        if( $gift->save() ){
            return redirect()->route( 'gift.edit', $gift->id )->with('status','Sửa thành công');
        }
        return back()->with('status','Sửa lỗi');
    }

    public function remove(Request $request){
        if( $request->ajax() && $request->isMethod('post')){
            $id = $request->input('id');
            if( is_array( $id ) ){
                Gift::destroy($id);
            }else{
                Gift::destroy($id);
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
