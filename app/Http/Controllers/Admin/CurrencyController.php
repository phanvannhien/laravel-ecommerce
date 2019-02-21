<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Facade

use Validator;

// Models

use App\Currencies;

class CurrencyController extends Controller
{

    public function index(){
        $data = Currencies::orderBy('code')->paginate();
        return view('admin.currencies.index', compact('data'));
    }

    public function create(){
        return view('admin.currencies.create');
    }

    public function store(Request $request){

        $rules = [
            'code' => 'required|string|max:20',
            'symbol' => 'required|string|max:20',
            'name' => 'required|string|max:100',
            'exchange_rate' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $data = new Currencies();
        $data->code = $request->input('code');
        $data->symbol = $request->input('symbol');
        $data->name = $request->input('name');
        $data->exchange_rate = $request->input('exchange_rate');
        $data->status = $request->input('status');

        if( $data->save() ){
            return redirect()->route( 'currency.edit', $data->id )
                ->with('status', trans('app.success'));
        }
        return back()->with('status',trans('app.fail'));

    }

    public function edit( Request $request, $id ){
        $data = Currencies::findOrFail( $id );
        return view('admin.currencies.edit', compact('data'));

    }

    public function update(Request $request, $id){
        $rules = [
            'code' => 'required|string|max:20',
            'symbol' => 'required|string|max:20',
            'name' => 'required|string|max:100',
            'exchange_rate' => 'required|numeric',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }


        $data = Currencies::findOrFail( $id );
        $data->code = $request->input('code');
        $data->symbol = $request->input('symbol');
        $data->name = $request->input('name');
        $data->exchange_rate = $request->input('exchange_rate');
        $data->status = $request->input('status');

        if( $data->save() ){
            return redirect()->route( 'currency.edit', $data->id )->with('status',trans('app.success'));
        }
        return back()->with('status',trans('app.fail'));
    }

}
