<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div id="logo">
                    <h1>
                        <a href="{{ url('/') }}">
                            {{ config('app.name') }}
                        </a>
                    </h1>
                </div>
            </div>
            <div class="col-md-8">
                <nav id="main-nav" class="clearfix">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li><a href="#">Tin mới</a></li>
                        <li><a href="#">Gần bạn</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-2">
                <div id="user-area" class="">
                    <ul id="user-nav" class="clearfix">
                        @if( Auth::check() )
                            <?php

                            ?>
                        <li>
                            <a href="#" class="bag-number text-grey">
                                <i class="far fa-bell"></i><span class="badge badge-success">9+</span>
                            </a>


                        </li>
                        <li id="pop-user" class="">
                            <a class="" href="#">
                                <img width="30" class="img-thumbnail rounded-circle" src="{{ Auth::user()->getAvatar() }}" alt="">
                                {{ Auth::user()->user_name }}
                            </a>
                        </li>
                        @else
                        <li>
                            <a data-toggle="modal"
                               data-target="#modal-login"
                               href="#"
                               class="pop-login text-grey">
                                <i class="far fa-user-circle fa-lg"></i> Đăng nhập</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </div>
</header>
<div id="featured-tags">

    @foreach( App\Category::whereNull('parent_id')->select('id','category_name','slug')->get() as $cat)
        <a class="btn btn-sm btn-primary mr-2" href="{{ route('category.product',[
            'category_slug' => $cat->slug,
            'cat_id' => $cat->id,
        ]) }}">
            {{ $cat->category_name }}
        </a>
    @endforeach


</div>
