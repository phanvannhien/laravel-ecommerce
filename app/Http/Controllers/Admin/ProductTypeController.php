<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Validator;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index(){
        $data = Type::orderBy('type_name')->paginate();
        return view('admin.types.index', compact('data'));
    }

    public function create(){

        return view('admin.types.create');
    }

    public function store(Request $request){
        $rules = [
            'type_name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $data = new Type();
        $data->type_name = $request->input('type_name');

        if( $data->save() ){
            return redirect()->route( 'type.edit', $data->id )->with('status', trans('app.success'));
        }
        return back()->with('status',trans('app.fail'));


    }

    public function edit( Request $request, $id ){
        $data = Type::findOrFail( $id );
        return view('admin.types.edit', compact('data'));

    }

    public function update(Request $request, $id){
        $rules = [
            'type_name' => 'required|string',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }


        $data = Type::findOrFail( $id );
        $data->type_name = $request->input('type_name');

        if( $data->save() ){
            return redirect()->route( 'type.edit', $data->id )->with('status',trans('app.success'));
        }
        return back()->with('status',trans('app.fail'));
    }
}