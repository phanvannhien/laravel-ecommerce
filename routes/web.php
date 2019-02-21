<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function()
{
    Auth::routes();
    Route::post('auth/social', 'MemberController@social_login')->name('ajax.social.login');


    Route::get('/gioi-thieu-land-linking','HomeController@about')->name('company.about');
    Route::get('/dieu-khoan-su-dung','HomeController@terms')->name('company.terms');

    Route::get('/', 'HomeController@index');

    Route::get('/{slug}-p{id}.html', 'HomeController@detail')
        ->where([
            'slug' => '[a-z0-9-]+',
            'id' => '[0-9]+',
        ])
        ->name('product.detail');

    Route::get('/{slug}-b{blog_id}.html', 'HomeController@blogDetail')
        ->where([
            'slug' => '[a-z0-9-]+',
            'blog_id' => '[0-9]+',
        ])
        ->name('blog.detail');



    Route::get('/{category_slug}-c{cat_id}.html', 'HomeController@category')
        ->where([
            'category_slug' => '[a-z0-9-]+',
            'cat_id' => '[0-9]+',
        ])
        ->name('category.product');


    Route::get('/{category_slug}-{city_slug}-c{cat_id}-t{city_id}.html', 'HomeController@searchCity')
        ->where([
            'category_slug' => '[a-z0-9-]+',
            'city_slug' => '[a-z0-9-]+',
            'cat_id' => '[0-9]+',
            'city_id' => '[0-9]+',
        ])
        ->name('city.product');


    Route::get('/{category_slug}-{district_slug}-c{cat_id}-d{district_id}.html', 'HomeController@searchDistrict')
        ->where([
            'category_slug' => '[a-z0-9-]+',
            'district_slug' => '[a-z0-9-]+',
            'cat_id' => '[0-9]+',
            'district_id' => '[0-9]+',
        ])
        ->name('district.product');


    Route::post('search','HomeController@search')->name('search');


    Route::get('/u/{user_name}','HomeController@member')->name('member.show');

//Route::get('/fix','HomeController@fix');

// MediaManager
    Route::group(['prefix' => 'file-manager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });


    Route::get('/comments', 'CommentController@index');

    Route::group([
        'middleware' => 'auth'
    ], function(){



        Route::post('/comments', 'CommentController@store');
        Route::put('/comments/{comment}', 'CommentController@update');
        Route::delete('/comments/{comment}', 'CommentController@destroy');


        Route::get('/contact', 'MessageController@contact');
        Route::get('/messages', 'MessageController@index');
        Route::post('/messages', 'MessageController@store');

        //User
        Route::group([
            'prefix' => 'thanh-vien'
        ], function(){

            Route::get('/', 'MemberController@page')->name('user.page');
            Route::get('bai-viet.html', 'MemberController@post')->name('user.post');
            Route::get('ban-be.html', 'MemberController@post')->name('user.friends');
            Route::get('chan.html', 'MemberController@post')->name('user.block');
            Route::get('ho-so.html', 'MemberController@profile')->name('user.profile');
            Route::post('ho-so.html', 'MemberController@profileSave')->name('user.profile.save');
            Route::get('mat-khau.html', 'MemberController@password')->name('user.password');
            Route::post('mat-khau.html', 'MemberController@passwordSave')->name('user.password.save');
            Route::get('dang-xuat.html', 'MemberController@logout')->name('user.logout');
            Route::get('yeu-thich.html', 'MemberController@favorite')->name('user.favorite');
            Route::delete('yeu-thich.html', 'MemberController@removeFavorite')->name('user.favorite.remove');

            // Bai viet
            Route::group([
                'prefix' => 'bai-viet'
            ], function(){
                // post
                Route::get('tao-moi.html', 'MemberController@create')->name('user.post.create');
                Route::post('tao-moi.html', 'MemberController@createPost')->name('user.post.save');

                Route::get('/{slug}.html', 'MemberController@editProduct')->name('user.post.edit');
                Route::post('/{slug}.html', 'MemberController@updateProduct')->name('user.post.update');
            });


        });







    });



    /**
     * Ajax
     */
    Route::group([
        'prefix' => 'ajax',
    ], function() {
        Route::get('district', 'Admin\AjaxController@district')->name('ajax.district');
        Route::get('ward', 'Admin\AjaxController@ward')->name('ajax.ward');

        Route::post('add-favorite', 'Admin\AjaxController@add_favorite')->name('ajax.add_favorite')->middleware('auth:web');
        Route::post('request-friend', 'Admin\AjaxController@requestAddFriend')->name('ajax.add_friend')->middleware('auth:web');


    });


    // Admin route
    Route::group([
        'prefix' => 'administration'
    ], function(){

        Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login.submit');

        Route::group([
            'middleware' => ['auth:admin']
        ], function(){

            Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
            Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');


            Route::resource('continent','ContinentController');
            Route::resource('country','CountryController');
            Route::resource('city','CityController');
            Route::resource('district','DistrictController');
            Route::resource('ward','WardController');

            // User
            Route::group([
                'prefix' => 'users',
            ], function(){
                Route::resource('user', 'Admin\UserController');
                Route::resource('user_group', 'Admin\UserGroupController');
                Route::post('user/grid', 'Admin\UserController@gridAction')->name('user.grid');
            });

            // Product
            Route::group([
                'prefix' => 'product',
            ], function(){
                Route::resource('categories','CategoryController');
                Route::resource('product','ProductController');
                Route::post('product/remove','ProductController@remove')->name('product.remove');
                Route::resource('investor','Admin\InvestorController');
                Route::resource('type','Admin\ProductTypeController');

                Route::resource('attribute','Admin\AttributeController');
            });

            //Route::resource('contact','Admin\ContactController');

            // Blog
            Route::group([
                'prefix' => 'blog',
            ], function(){
                Route::resource('blog','Admin\BlogController');
                Route::resource('blog-category','Admin\BlogCategoryController');
            });


            // System
            Route::group([
                'prefix' => 'system',
            ], function(){
                Route::get('/admin-user',array('as'=>'admin_user.index', 'uses' => 'Admin\AdminController@all'));
                Route::get('/admin-user/{id}/change-password',array('as'=>'admin_user.change_password', 'uses' => 'Admin\AdminController@change_password'));
                Route::post('/admin-user/{id}/change-password',array('as'=>'admin_user.change_password.save', 'uses' => 'Admin\AdminController@save_change_password'));

                Route::resource('currency','Admin\CurrencyController');
                Route::resource('inventory','Admin\StoreController');
                Route::resource('shipping','Admin\ShippingController');
                Route::get('payment','Admin\PaymentController@index')->name('payment.index');



            });


//         Route::resource('gift','GiftController');
//         Route::resource('voucher','Admin\VoucherController');
//         Route::post('voucher/remove','Admin\VoucherController@remove')->name('voucher.remove');
//         Route::post('voucher/grid','Admin\VoucherController@grid')->name('voucher.grid');
//         Route::get('voucher/tools/import','Admin\VoucherController@import')->name('voucher.import');
//         Route::post('voucher/tools/import','Admin\VoucherController@importPost')->name('voucher.import.post');

            // Configuration
            Route::get('configuration',array('as'=>'back.configuration', 'uses' => 'ConfigurationController@configuration'));
            Route::post('configuration',array('as'=>'back.configuration.save', 'uses' => 'ConfigurationController@configurationSave'));



        });



        // SEO Tools
        Route::get('/seo/sitemap', 'Admin\AdminController@generateSitemap')->name('generate.sitemap');

    });

});






Route::get('sitemap-store', function()
{
    // create sitemap categories
    $sitemap_cats = App::make("sitemap");
    $sitemap_cities = App::make("sitemap");
    $sitemap_districts = App::make("sitemap");


    $cats = DB::table('categories')->get();
    foreach ($cats as $cat)
    {
        $link = route('category.product',[
            'category_slug' => $cat->slug,
            'cat_id' => $cat->id,
        ]);
        $sitemap_cats->add( $link , null, '0.5', 'weekly');

        // cities
        $cities = DB::table('cities')->get();
        foreach ($cities as $city){
            $link_city = route('city.product',[
                'category_slug' => $cat->slug,
                'city_slug' => $city->slug,
                'cat_id' => $cat->id,
                'city_id' => $city->matp,
            ]);
            $sitemap_cities->add( $link_city , null, '0.5', 'weekly');
        }


        // districts
        $districts = DB::table('district')->get();
        foreach ($districts as $district){
            $link_district = route('district.product',[
                'category_slug' => $cat->slug,
                'district_slug' => $district->slug,
                'cat_id' => $cat->id,
                'district_id' => $district->maqh,
            ]);
            $sitemap_districts->add( $link_district , null, '0.5', 'weekly');
        }

    }

    $sitemap_cities->store('xml','sitemap-cities');
    $sitemap_cats->store('xml','sitemap-categories');
    $sitemap_districts->store('xml','sitemap-districts');

    // create sitemap products
    $sitemap_posts = App::make("sitemap");
    $posts = DB::table('products')->orderBy('created_at', 'desc')->get();
    foreach ($posts as $post)
    {
        $sitemap_posts->add( route('product.detail',[
            'slug' => $post->slug,
            'id' => $post->id
        ]), $post->updated_at, '0.5', 'daily');
    }
    $sitemap_posts->store('xml','sitemap-posts');


    // create sitemap index
    $sitemap = App::make ("sitemap");
    $sitemap->addSitemap(URL::to('sitemap-categories.xml'));
    $sitemap->addSitemap(URL::to('sitemap-cities.xml'));
    $sitemap->addSitemap(URL::to('sitemap-districts.xml'));
    $sitemap->addSitemap(URL::to('sitemap-posts.xml'));

    // create file sitemap.xml in your public folder (format, filename)
    $sitemap->store('sitemapindex','sitemap');
});



