<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'max:100','unique:users'],
            'phone' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:100', 'confirmed'],
        ],[
            'user_name.required' => 'Vui lòng nhập tên đăng nhập',
            'user_name.string' => 'Vui lòng nhập tên đăng nhập dạng chữ cái a-z, A-Z',
            'user_name.max' => 'Vui lòng nhập tên đăng nhập tối đa 100 ký tự',
            'user_name.unique' => 'Tên đăng nhập đã được sử dụng',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập email đúng định dạng',
            'email.max' => 'Vui lòng nhập email tối đa 254 ký tự',
            'email.unique' => 'Email này đã được sử dụng',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.max' => 'Vui lòn nhập số điện thoại tối đa 10 số',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Vui lòng nhập mật khẩu tối thiểu 6 kí tự',
            'password.max' => 'Vui lòng nhập mật khẩu tối đa 100 kí tự',
            'password.confirmed' => 'Nhắc lại mật khẩu không trùng khớp',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return User::create([
            'user_name' => $data['user_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        return response()->json([
            'success' => true
        ]);
    }
}
