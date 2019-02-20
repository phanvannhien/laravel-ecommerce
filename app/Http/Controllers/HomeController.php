<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Filters\ProductFilter;
use App\Models\Blog;
use App\Models\Cities;
use App\Models\District;
use App\Product;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastest = Product::orderBy('created_at','DESC')->limit( 10 )->get();
        $topUsers = User::withCount('products')->orderBy('products_count', 'desc')->limit(10)->get();

        return view('home', compact('lastest','topUsers'));
    }


    public function category( Request $request, $category_slug, $cat_id ){

        $category = Category::findOrFail( $cat_id );
        $topUsers = User::withCount('products')->orderBy('products_count', 'desc')->limit(10)->get();

        if( $request->has('orderby') ){
            $posts = Product::whereHas('categories',function ($query) use ($category){
                $query->where('category_id',  $category->id );
            })->orderBy( $request->input('orderby') , $request->input('dir') )
                ->paginate();;
        }else{
            $posts = Product::whereHas('categories',function ($query) use ($category){
                $query->where('category_id',  $category->id );
            })->orderBy('title','ASC')
                ->paginate();
        }



        return view('products.category', compact('category', 'posts','topUsers'));

    }

    public function detail(Request $request, $slug, $id){

        $product = Product::findBySlugOrFail($slug);
        $product->increment('viewed');


        $user = $product->user;

        // Set recent

        if( Auth::check() ){
            $authUser = Auth::user();
            $recent = $authUser->recent();


            if( $recent->count() >= 5 ){
                $authUser->recent()->delete([
                    'product_id' => $authUser->recent->last()->product_id
                ]);

            }else{

                if( !$recent->where('product_id', $product->id )->first() ){
                    $authUser->recent()->create([
                        'product_id' => $product->id
                    ]);
                }
            }
        }

        return view('products.detail', compact('product','user'));
    }

    public function search(Request $request){


        if( $request->filled('category') && !$request->filled('matp') && !$request->filled('maqh') ){
            $category = Category::findOrFail( $request->input('category') );

            return redirect()->route('category.product',[
                'category_slug' => $category->slug,
                'cat_id' => $category->id
            ]);
        }


        if( $request->filled('category') && $request->filled('matp') ){

            $category = Category::findOrFail( $request->input('category') );
            $city = Cities::findOrFail( $request->input('matp') );

            if( $request->filled('maqh') ){

                $district = District::findOrFail($request->input('maqh'));

                return redirect()->route('district.product', [
                    'category_slug' => $category->slug,
                    'district_slug' => $district->slug,
                    'cat_id' => $category->id,
                    'district_id' => $district->maqh,
                    'title' => $request->input('title'),
                    'price_range' => $request->input('price_range'),
                ]);
            }

            return redirect()->route('city.product', [
                'category_slug' => $category->slug,
                'city_slug' => $city->slug,
                'cat_id' => $category->id,
                'city_id' => $city->matp,
                'title' => $request->input('title'),
                'price_range' => $request->input('price_range'),
            ]);

        }

        return back();

    }

    public function searchCity(Request $request, ProductFilter $filter, $category_slug, $city_slug, $cat_id, $city_id){


//        $request->request->add(['category' => $cat_id]);
//        $request->request->add(['matp' => $city_id]);

        $category = Category::findOrFail( $cat_id );
        $requestCity = Cities::findOrFail($city_id);

        $topUsers = User::withCount('products')->orderBy('products_count', 'desc')->limit(10)->get();
        $posts = Product::filter( $filter )
            ->whereHas('categories', function($query) use ($cat_id){
                return $query->where('category_id', $cat_id );
            })
            ->where('matp', $city_id)
            ->paginate();

        return view('products.category', compact('category', 'posts','topUsers','requestCity'));
    }

    public function searchDistrict(Request $request, ProductFilter $filter, $category_slug, $district_slug, $cat_id, $district_id){


        $category = Category::findOrFail( $cat_id );
        $requestDictrict = District::findOrFail($district_id);
        $requestCity = Cities::findOrFail($requestDictrict->matp);

//        $request->request->add(['category' => $cat_id]);
//        $request->request->add(['matp' => $requestCity->matp ]);
//        $request->request->add(['maqh' => $district_id ]);

        $topUsers = User::withCount('products')->orderBy('products_count', 'desc')->limit(10)->get();
        $posts = Product::filter( $filter )
            ->whereHas('categories', function($query) use ($cat_id){
                return $query->where('category_id', $cat_id );
            })
            ->where('maqh', $district_id)
            ->paginate();

        return view('products.category', compact('category', 'posts','topUsers','requestCity','requestDictrict'));
    }

    public function member(Request $request, $user_name)
    {
        $user = User::where( 'user_name', $user_name)->firstOrFail();
        $posts = Product::where('user_id', $user->id)->orderBy('created_at','DESC')->paginate();
        return view('members.show', compact('user', 'posts'));
    }


    public function blogDetail(Request $request, $slug, $blog_id){
        $blog = Blog::findOrFail( $blog_id );
        return view('blogs.detail', compact('blog'));
    }

}
