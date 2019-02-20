<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Hash;


use Spatie\Sitemap\SitemapGenerator;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }
    public function change_password(){

        $user = Auth::user();
        return view('admin.adminusers.change_password',compact('user'));
    }

    public function save_change_password(Request $request){
        $user = Auth::user();
        $old_password = $request->input('old_pass');
        $rules['old_pass'] = 'required';

        if( !empty($old_password) ){
            $rules['password'] = 'required|min:6|max:100|confirmed';
        }
        $validator = Validator::make($request->all(), $rules,[
            'old_pass.required' => 'Vui lòng nhập mật khẩu cũ',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Vui lòng nhập mật khẩu ít nhất 6 kí tự',
            'password.max' => 'Vui lòng nhập mật khẩu tối đa 100 kí tự',
            'password.confirmed' => 'Nhắc lại mật khẩu không trùng khớp',
        ]);
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        if( !empty($old_password) ) {
            $new_password = $request->input('password');
            if (Hash::check($old_password, $user->getAuthPassword())) {
                $user->password = Hash::make($new_password);
            } else {
                return back()->with(['warning' => 'Mật khẩu cũ không đúng']);
            }
        }

        if($user->save()) {
            return back()->with(['status' => 'Cập nhật thành công']);
        }

        return back()->with(['warning' => 'Cập nhật lỗi']);;
    }

    public function generateSitemap(){
        SitemapGenerator::create( url('/') )->writeToFile( public_path('sitemap.xml') );
        return 'Generate sitemap success';
    }
}
