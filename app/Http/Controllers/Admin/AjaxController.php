<?php

namespace App\Http\Controllers\Admin;

use App\Models\District;
use App\Models\Wards;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


// Models

use App\User;


// Facde

use Auth;


class AjaxController extends Controller
{
    public function district( Request $request ){
        if( $request->ajax() ){
            $id = $request->input('id');
            $districts = District::where('matp', $id)
                ->orderBy('name')->select('maqh as id', 'name as text' )
                ->get();
            return response()->json($districts );
        }
    }

    public function ward( Request $request ){
        if( $request->ajax() ){
            $id = $request->input('id');
            $wards = Wards::where('maqh', $id)->orderBy('name')->select('xaid as id', 'name as text' )->get();
            return response()->json( $wards );
        }
    }

    public function add_favorite(Request $request){
        if( $request->ajax() ){
            $user = Auth::user();
            $pid = $request->input('id');
            if( $user->loved( $pid ) ){
                $user->loves()->detach( ['product_id' => $pid] );
                return response()->json(['success' => true, 'type' => 'remove' ]);
            }else{
                $user->loves()->attach( ['product_id' => $pid] );
                return response()->json(['success' => true, 'type' => 'add' ]);
            }
            return response()->json(['success' => false, 'msg' =>  trans('app.fail') ]);

        }
    }


    public function requestAddFriend(Request $request){
        if( $request->ajax() ){
            $user = Auth::user();
            $contact_id = $request->input('id');
            if( $user->contacted($contact_id) ){
                return response()->json(['success' => true, 'msg' =>  'Đã gửi yêu cầu kết bạn' ]);
            }else{
                $user->contacts()->create(['contact_id' => $contact_id, 'action_user_id' => $user->id ]);
                return response()->json(['success' => true, 'msg' =>  'Đã gửi yêu cầu kết bạn thành công' ]);
            }
        }
    }

}
