<?php

namespace App\Http\Controllers\Admin;

use App\Models\Investor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;


class InvestorController extends Controller
{
    public function index(){
        $data = Investor::orderBy('brand_name')->paginate();
        return view('admin.investors.index', compact('data'));
    }

    public function create(){
        return view('admin.investors.create');
    }

    public function store(Request $request){
        $rules = [
            'investor_name' => 'required|string',
            //'investor_logo' => 'required|string',
            //'investor_description' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $data = new Investor();
        $data->brand_name = $request->input('investor_name');
        $data->brand_logo = $request->input('investor_logo');
        $data->brand_description = $request->input('investor_description');

        if( $data->save() ){
            return redirect()->route( 'investor.edit', $data->id )->with('status', trans('app.success'));
        }
        return back()->with('status',trans('app.fail'));


    }

    public function edit( Request $request, $id ){
        $data = Investor::findOrFail( $id );
        return view('admin.investors.edit', compact('data'));

    }

    public function update(Request $request, $id){
        $rules = [
            'investor_name' => 'required|string',
            //'investor_logo' => 'required|string',
            //'investor_description' => 'required|string',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }


        $data = Investor::findOrFail( $id );
        $data->brand_name = $request->input('investor_name');
        $data->brand_logo = $request->input('investor_logo');
        $data->brand_description = $request->input('investor_description');

        if( $data->save() ){
            return redirect()->route( 'investor.edit', $data->id )->with('status',trans('app.success'));
        }
        return back()->with('status',trans('app.fail'));
    }


}
