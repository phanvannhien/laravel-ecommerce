<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Models
 */

use App\Models\UserMedia;

/**
 * Facades
 */

use Auth;
use Validator;


class UserController extends Controller{


    public function getUser(Request $request){
        return Auth::user();
    }

    
    public function login(  Request $request ){

        $rules = [
            'phone' => 'required|string:max:12',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules,[
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ]);

        if ($validator->fails()) {
            return response()->json ( $validator->errors() );
        }

        $credentials = $request->only('phone', 'password');

    
        if (Auth::attempt($credentials)) {
            return response()->json( Auth::user() );
        }

        return response()->json(false);

    }
}