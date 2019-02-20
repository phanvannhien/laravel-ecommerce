<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProgramExport;
use App\Http\Filters\UserFilter;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Carbon\Carbon;
use DB;


class UserController extends Controller
{

    //
    public function index(Request $request, UserFilter $filters){

        $action = $request->input('action');
        
        if( $action == 'export' && $request->has('program') ){
            $data = User::filter($filters)
                ->orderBy('created_at','DESC')
                ->get();

            return Excel::download( new ProgramExport($request->input('program'), $data), 'users.xlsx' );
        }

        $data = User::filter($filters)
            ->orderBy('created_at','DESC')
            ->paginate();
    
        return view('admin.users.index', compact('data'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function show( $id ){
        $user = User::findOrFail( $id );
        return view('admin.users.show', compact('user'));
    }

    public function store( Request $request){

        $rules = [
            'email' => 'required|email',
            'phone' => 'required|min:10|max:12',
            'user_name' => 'required|min:6',
            'password' => 'required|min:6',
        ];


        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }


        $dob = Carbon::createFromDate( $request->input('year'), $request->input('month'), $request->input('day'), 'Asia/Ho_Chi_Minh' );

        $user = new User();
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->password = Hash::make($request->input('password'));
        $user->dob = $dob;
        $user->status = $request->input('status');
        $user->locked = 0;


        if($user->save()) {
            return redirect()->route('user.edit', $user)->with('status', trans('app.success') );

        }

        return back()->with('warning', trans('app.fail') );;
    }

    public function edit( $id ){
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $arrRules = [
            'full_name' => 'required|max:254',
            'phone' => 'required|max:12',
            'email' => 'required|email|max:254',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
        ];


        $validator = Validator::make($request->all(),$arrRules , [
            'phone.required' => 'Vui lònh nhập số điện thoại',
            'phone.max' => 'Vui lòn nhập số điện thoại tối đa 12 ký tự',
            'email.required' => 'Vui lòng nhập email',
            //'email.alpha_num' => 'Vui lòng nhập email dạng chữ và số',
            'email.email' => 'Vui lòng nhập email đúng định dạng',
            'email.max' => 'Vui lòng nhập email tối đa 254 ký tự',
            //'phone.unique' => 'Số điện thoại đã được sử dụng',
            // 'cmnn.unique' => 'Vui lòng nhập số CMNN',
            'day.required' => 'Vui lòng ngày sinh',
            'month.required' => 'Vui lòng chọn tháng sinh',
            'year.required' => 'Vui lòng chọn năm sinh',
        ] );


        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $dob = Carbon::createFromDate( $request->input('year'), $request->input('month'), $request->input('day'));
        $arrUpdate = [
            'full_name' => $request->input('full_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'dob' => $dob,
            'address' => $request->input('address'),
            'status' => $request->input('status'),
            'locked' => $request->input('locked'),
        ];


        $user->update($arrUpdate);

        if( $request->has('role') && $request->input('role') != '' ){
            $role = Role::findOrFail($request->input('role'));

            if( !$user->hasRole($role)  ){
                $user->roles()->detach();
                $user->attachRole($role);
            }
        }


        if ($user)
            return back()->with('status', 'Cập nhật thành công');
        return back()->with('status', 'Cập nhật lỗi');
    }

    public function active( $id ){
        $user = User::findOrFail( $id );
        return view('admin.users.active', compact('user'));
    }

    public function activeUser(Request $request, $user_id){

    }

    public function branch(Request $request, $user_id){
        $user = User::where('user_id', $user_id)->first();
        return view('admin.users.tree', compact('user'));
    }

    public function wallet(Request $request, $id, WalletFilter $filter ){
        $user = User::findOrFail( $id );
        $wallet = UserWallet::filter($filter)->where('user_id',$user->user_id )
            ->orderBy('created_at','DESC')
            ->paginate();
        return view('admin.users.wallet', compact('user','wallet'));
    }

    public function transaction(Request $request, $id, UserTransactionFilter $filter){
        $user = User::findOrFail( $id );
        $transaction = UserTransaction::filter($filter)
            ->where('user_id',$user->user_id )
            ->orderBy('created_at','DESC')
            ->paginate();


        return view('admin.users.transaction', compact('user','transaction'));
    }

    public function banks(Request $request, $id){
        $user = User::findOrFail($id);
        $banks = $user->banks()->paginate();
//        dd($banks);

        return view('admin.users.banks', compact('banks','user'));
    }

    public function banksEdit(Request $request, $user_id, $bank_id){
        $bank = UserBanks::find($bank_id);
        $user = User::where('user_id',$user_id)->firstOrFail();
        if( !$bank ){
            return back()->with('status', 'Không tồn tại');
        }
        return view('admin.users.bank_edit', compact('bank','user'));
    }


    public function banksUpdate(Request $request, $user_id, $bank_id){
        $rules = [
            'bank_full_name' => 'required|max:120',
            'bank_acc_number' => 'required|numeric',
            'bank_location' => 'required|max:254',
        ];

        $messages = array(
            'bank_full_name.required' => 'Vui lòng nhập Tên tài khoản',
            'bank_full_name.max' => 'Vui lòng nhập Tên tài khoản tối đa 254 ký tự',
            'bank_acc_number.required' => 'Vui lòng nhập số tài khoản',
            'bank_acc_number.numeric' => 'Vui lòng nhập số tài khoản dạng số',
            //'bank_acc_number.unique' => 'Số tài khoản đã tồn tại',
            'bank_location.required' => 'Vui lòng nhập chi nhánh ngân hàng',
            'bank_location.max' => 'Vui lòng nhập chi nhánh ngân hàng tối đa 254 ký tự',
        );


        $validator = Validator::make($request->all(), $rules, $messages );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $bank = UserBanks::findOrFail($bank_id);

        $bank->bank_name = $request->input('bank_name');
        $bank->bank_full_name = $request->input('bank_full_name');
        $bank->bank_acc_number = $request->input('bank_acc_number');
        $bank->bank_location = $request->input('bank_location');
        $bank->bank_swift_code = $request->input('bank_swift_code');
        $bank->locked = $request->input('locked');

        if( $bank->save() ){
            return back()->with('status','Sửa thành công');
        }
        return back()->with('warning','Cập nhật lỗi');

    }

    public function gridAction(Request $request){
        $action = $request->input('action');

        if( $action == 'export_all' ){
            return Excel::download( new UsersExport, 'users.xlsx' );
        }
    }

}
