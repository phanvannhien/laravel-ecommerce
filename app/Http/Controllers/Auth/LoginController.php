<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')
            ->except('logout');
    }

    public function username()
    {
        return 'phone';
    }


    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required',
            'password' => 'required|string',
        ],[
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ]);
    }


    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        if ($request->ajax()){

//            if( $user->user_status == 0 ){
//                Auth::logout();
//                return response()->json([
//                    'message' => 'Your account is disabled',
//                    'errors' => [ $user->phone => 'Your account is disabled' ]
//                ], 401);
//            }

            return response()->json([
                'auth' => auth()->check(),
                'user' => $user,
                'intended' => $this->redirectPath(),
            ]);

        }
        return response()->redirectToIntended();
    }


}
