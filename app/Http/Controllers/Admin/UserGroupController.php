<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
// Models
use App\UserGroup;


class UserGroupController extends Controller
{
    public function index(){
        $data = UserGroup::orderBy('group_name')->paginate();
        return view('admin.user_groups.index', compact('data'));
    }

    public function create(){
        return view('admin.user_groups.create');
    }

    public function store(Request $request){
        $rules = [
            'group_name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $data = new UserGroup();
        $data->group_name = $request->input('group_name');


        if( $data->save() ){
            return redirect()->route( 'user_group.edit', $data->id )
                ->with('status', trans('app.success'));
        }
        return back()->with('status',trans('app.fail'));


    }

    public function edit( $id ){
        $data = UserGroup::findOrFail( $id );
        return view('admin.user_groups.edit', compact('data'));

    }

    public function update(Request $request, $id){
        $rules = [
            'group_name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules );
        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }


        $data = UserGroup::findOrFail( $id );
        $data->group_name = $request->input('group_name');


        if( $data->save() ){
            return redirect()
                ->route( 'user_group.edit', $data->id )
                ->with('status',trans('app.success'));
        }
        return back()->with('status',trans('app.fail'));
    }

}
