<?php

namespace App\Http\Controllers\Admin;

use App\Exports\VoucherExport;
use App\Http\Filters\VoucherFilter;
use App\Imports\VoucherImport;
use App\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Excel;


class VoucherController extends Controller
{
    //
    public function index(Request $request, VoucherFilter $filter){
        $data = Voucher::filter($filter)->paginate(50);
        return view('admin.vouchers.index', compact('data'));
    }

    public function create(){
        return view('admin.vouchers.create');
    }

    public function store(Request $request){
        $rules = [
            'voucher' => 'required|string',
            'voucher_value' => 'required',
            'program' => 'required',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $data = new Voucher();
        $data->voucher = $request->input('voucher');
        $data->voucher_value = $request->input('voucher_value');
        $data->program = $request->input('program');
        $data->is_use = 0;

        if( $data->save() ){
            return redirect()->route( 'voucher.edit', $data->id )->with('status','Tạo thành công');
        }
        return back()->with('warning','Tạo lỗi');
    }

    public function edit($id){
        $data = Voucher::findOrFail($id);
        return view('admin.vouchers.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $data = Voucher::findOrFail($id);
        if( $data->is_use ){
            return back()->with('warning','Voucher đã được sử dụng không thể sửa');
        }

        $rules = [
            'voucher' => 'required|string',
            'voucher_value' => 'required',
            'program' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $data->voucher = $request->input('voucher');
        $data->voucher_value = $request->input('voucher_value');
        $data->program = $request->input('program');
        if( $data->save() ){
            return redirect()->route( 'voucher.edit', $data->id )->with('status','Sửa thành công');
        }
        return back()->with('warning','Sửa lỗi');

    }

    public function remove(Request $request){


        if( $request->ajax() && $request->isMethod('post')){
            $id = $request->input('id');
            if( is_array( $id ) ){
                Voucher::destroy($id);
            }else{
                Voucher::destroy($id);
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function grid(Request $request){
        $action = $request->input('action');

        if( $action == 'export_all' ){
            return Excel::download( (new VoucherExport)->ids([]), 'vouchers.xlsx' );
        }

        if( $action == 'export_selected' ){

            return Excel::download( (new VoucherExport)->ids($request->input('id')), 'vouchers.xlsx' );
        }
    }

    public function import(Request $request){
        return view('admin.vouchers.import');
    }

    public function importPost(Request $request){

        if( $request->hasFile('file') ){
            try {
                Excel::import(new VoucherImport, request()->file('file'));
                return back()->with('status', 'Import thành công' );
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();

                foreach ($failures as $failure) {
                    $failure->row(); // row that went wrong
                    $failure->attribute(); // either heading key (if using heading row concern) or column index
                    $failure->errors(); // Actual error messages from Laravel validator
                }
                return back()->withErrors( $failures );
            }
        }
        return back()->with( 'warning','Chọn file import' );




    }



}
