<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\SocialAccount;
use App\Models\ProductType;
use App\Product;
use App\User;

use Auth;
use Validator;
use DB;


class MemberController extends Controller
{

    public function page(){
        $user = Auth::user();
        return view('members.page', compact('user'));
    }

    public function profile(){
        $user = Auth::user();
        return view('members.profile', compact('user'));
    }

    public function profileSave(Request $request){
        $user = Auth::user();

        if($user->locked){
            return back()->with('warning',  trans('user.account_locked') );
        }

        $arrRules = [
            'full_name' => 'required|max:254',
            'phone' => 'required|max:12',
            'email' => 'required|email|max:254',
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
        ];

        if( $request->input('phone') !== $user->phone ){
            $arrRules = [
                'phone' => 'unique:users',
            ];
        }


        $validator = Validator::make($request->all(),$arrRules , [
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.max' => 'Vui lòng nhập số điện thoại tối đa 12 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập email đúng định dạng',
            'email.max' => 'Vui lòng nhập email tối đa 254 ký tự',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
            'day.required' => 'Vui lòng ngày sinh',
            'month.required' => 'Vui lòng chọn tháng sinh',
            'year.required' => 'Vui lòng chọn năm sinh',
        ]);


        if ($validator->fails()) {
            return back()->withErrors ( $validator )->withInput();
        }

        $dob = Carbon::createFromDate( $request->input('year'), $request->input('month'), $request->input('day'));
        $arrUpdate = [
            'full_name' => $request->input('full_name'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'dob' => $dob,
            'address' => $request->input('address'),
            'matp' => $request->input('matp'),
            'maqh' => $request->input('maqh'),
            'xaid' => $request->input('xaid'),
            'locked' => 0
        ];

        $user->update($arrUpdate);

        if ($user)
            return back()->with('status', trans('app.success') );
        return back()->with('status', trans('app.fail') );
    }

    public function password(){
        $user = Auth::user();
        return view('members.password', compact('user'));
    }

    public function passwordSave( Request $request ){

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

        return back()->with(['status' => 'Cập nhật lỗi']);

    }

    public function social_login(Request $request){
        if( $request->ajax() ){

            $social_data = $request->input('social_data');

            $account = SocialAccount::whereProvider( $social_data['provider'] )
                ->whereProviderUserId( $social_data['id'] )
                ->first();

            if ($account) {

                auth()->login($account->user);
                return response()->json(array(
                    'success' => true
                ));

            } else {


                $email = $social_data['email'];
                $account = new SocialAccount([
                    'provider_user_id' => $social_data['id'],
                    'provider' => $social_data['provider']
                ]);
                $user = User::whereEmail( $social_data['email'] )->first();
                if (!$user) {

                    $user = User::create([
                        'email' => $email,
                        'user_name' => str_slug($social_data['name'],'_'),
                        'password' => bcrypt($social_data['name']),
                    ]);
                }

                $account->user()->associate($user);
                $account->save();
                auth()->login($user);
                return response()->json(array(
                    'success' => true
                ));
            }
        }
    }

    public function post()
    {
        $user = Auth::user();
        $posts = Product::where('user_id', Auth::id())->paginate();
        return view('members.posts.index', compact('user','posts'));
    }

    public function create(){
        $user = Auth::user();
        $mode = true;
        return view('members.posts.form', compact('user','mode'));
    }

    public function createPost(Request $request){
        //if( $request->ajax() ){
            $rules = [
                'title' => 'required|string|max:254',
                'description' => 'required|string',
                'price' => 'required|string|max:254',
                'address' => 'required|max:254',
                'matp' => 'required|numeric',
                'maqh' => 'required|numeric',
                'xaid' => 'required|numeric',
                'real_cat' => 'required',
                'galleries' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'area' => 'required|numeric',
            ];

            $validator = Validator::make($request->all(), $rules,[
                'title.required' => 'Vui lòng nhập tiêu đề',
                'description.required' => 'Vui lòng nhập mô tả',
                'price.required' => 'Vui lòng nhập Giá bán',
                'address.required' => 'Vui lòng nhập Địa chỉ',
                'matp.required' => 'Vui lòng Chọn Tỉnh/ Thành Phố',
                'maqh.required' => 'Vui lòng chọn Quận/ Huyện',
                'xaid.required' => 'Vui lòng Chọn Phường/ Xã',
                'real_cat.required' => 'Vui lòng chọn Danh mục',
                'galleries.required' => 'Vui lòng chọn hình ảnh',
                'area.required' => 'Vui lòng nhập diện tích',
                'area.numeric' => 'Vui lòng nhập diện tích dạng số',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
//                return response()->json( ['success' => false, 'err' => $validator->errors() ]);
            }

            $product = new Product();
            $product->title = $request->input('title');
            $product->price = str_replace(',','',$request->input('price'));
            $product->description = $request->input('description');
            $product->address = $request->input('address');
            $product->matp = $request->input('matp');
            $product->maqh = $request->input('maqh');
            $product->xaid = $request->input('xaid');
            $product->lat = $request->input('lat');
            $product->lng = $request->input('lng');
            $product->vr = $request->input('vr');
            $product->area = $request->input('area');
            $product->legal = $request->input('legal');

            $product->user_id = Auth::id();

            $arr = [];
            if( $request->has('galleries') ){
                foreach ( $request->get('galleries') as $img){
                    array_push($arr, ['image_url' => $img] );
                }
            }
            if( count( $arr ) ){
                $product->image = $arr[0]['image_url'];
            }

            
            try{
                DB::beginTransaction();
                if( $product->save() ){
                    //save categories
                    $product->categories()->attach( $request->input('real_cat') );
    
                    //save type
                    //$product->types()->attach( $request->input('real_type') );
    
                    // save images
                    if( count( $arr ) ){
                        $product->galleries()->createMany($arr);
                    }
                    DB::commit();
                    return back()->with('status', trans('app.success') );
                    //return response()->json(['success' => true, 'msg' =>  trans('app.success') ]);
                }

            }catch( Exception $e ){
                DB::rollBack();
            }
            return back()->with('warning', trans('app.fail') );
            //return response()->json(['success' => false , 'msg' =>  trans('app.success') ]);

        //}
    }

    public function editProduct( $slug ){

        $post = Product::findBySlugOrFail($slug);
        $user = Auth::user();
        $mode = false;
        return view('members.posts.form', compact('post','user','mode'));
    }

    public function updateProduct(Request $request, $slug){



        $product = Product::findBySlugOrFail($slug);

        $rules = [
            'title' => 'required|string|max:254',
            'description' => 'required|string',
            'price' => 'required|string|max:254',
            'address' => 'required|max:254',
            'matp' => 'required|numeric',
            'maqh' => 'required|numeric',
            'xaid' => 'required|numeric',
            'real_cat' => 'required',
            //'real_type' => 'required',
            'galleries' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'area' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules,[
            'title.required' => 'Vui lòng nhập tiêu đề',
            'description.required' => 'Vui lòng nhập mô tả',
            'price.required' => 'Vui lòng nhập Giá bán',
            'address.required' => 'Vui lòng nhập Địa chỉ',
            'matp.required' => 'Vui lòng Chọn Tỉnh/ Thành Phố',
            'maqh.required' => 'Vui lòng chọn Quận/ Huyện',
            'xaid.required' => 'Vui lòng Chọn Phường/ Xã',
            //'real_type.required' => 'Vui lòng chọn loại',
            'real_cat.required' => 'Vui lòng chọn Danh mục',
            'galleries.required' => 'Vui lòng chọn hình ảnh',
            'area.required' => 'Vui lòng nhập diện tích',
            'area.numeric' => 'Vui lòng nhập diện tích dạng số',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $product->title = $request->input('title');
        $product->price = str_replace(',','',$request->input('price'));
        $product->description = $request->input('description');
        $product->address = $request->input('address');
        $product->matp = $request->input('matp');
        $product->maqh = $request->input('maqh');
        $product->xaid = $request->input('xaid');
        $product->lat = $request->input('lat');
        $product->lng = $request->input('lng');
        $product->vr = $request->input('vr');
        $product->area = $request->input('area');
        $product->legal = $request->input('legal');


        $arr = [];
        if( $request->has('galleries') ){
            foreach ( $request->get('galleries') as $img){
                array_push($arr, ['image_url' => $img] );
            }
        }
        if( count( $arr ) ){
            $product->image = $arr[0]['image_url'];
        }


        try{
            DB::beginTransaction();
            if( $product->save() ){
                //save categories
                $product->categories()->detach();
                $product->categories()->attach( $request->input('real_cat') );

                //save type
                //$product->types()->detach();
                //$product->types()->attach( $request->input('real_type') );

                // save images
                if( count( $arr ) ){
                    $product->galleries()->delete();
                    $product->galleries()->createMany($arr);
                }

                DB::commit();
                return back()->with('status', trans('app.success') );
            }

        }catch( Exception $e ){
            DB::rollBack();
        }

        return back()->with('warning', trans('app.fail') );

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function favorite(Request $request){
        $user = Auth::user();
        $posts = $user->loves()->paginate();
        return view('members.favorites', compact('posts','user'));
    }

    public function removeFavorite(Request $request){
        if( $request->has('product_id') ){
            $remove = Auth::user()->loves()->detach( ['product_id' => $request->input('product_id')] );
            if( $remove ){
                return back()->with('status','Đã xoá khỏi danh sách yêu thích' );
            }
        }
        return back()->with('warning','Có lỗi xảy ra');
    }


}
