@extends('layouts.app')

@section('main')
    <div id="product-slider">
        @foreach( $product->galleries as $image )
            <div class="p-slide-item">
                <a href="{{ $image->image_url }}" class="popup-image">
                    <img width="400" src="{{ $image->image_url }}" alt="">
                </a>
            </div>
        @endforeach
    </div>
    <div class="container py-5">
        <div class="row">
            <div id="sidebar" class="col-md-3">
                @include('members.partials.sidebar_out')


            </div>
            <div id="primary" class="col-md-9">
                <div id="primary-inner">
                    @include('partials.messages')
                    <h1>{{ $product->title }}</h1>
                    <div class="product-meta border bg-light p-3 mb-3">
                        <p class="m-0">
                            <i class="fas fa-map-pin"></i> {{ $product->getFullAddress() }} <br>
                            Chuyên mục: {!! $product->getCategoriesFront() !!}<br>
                            <span><i class="far fa-heart"></i> {{ $product->loves->count() }}</span>
                            <span><i class="far fa-comments"></i> {{ $product->comments->count() }}</span>
                        </p>
                        <p>
                            <i class="far fa-money-bill-alt"></i> <span class="text-secondary">Giá bán từ:</span> {!! $product->getPrice() !!} ( {{ App\Helpers\Price::convert_vietnamese( $product->price ) }} )
                            <br>
                            <i class="far fa-square"></i> <span class="text-secondary">Diện tích:</span> {{ $product->area }} <br>
                            <i class="fas fa-file-contract"></i> <span class="text-secondary">Pháp lý:</span> {{ $product->legal }}

                        </p>
                        <hr>


                        @if( auth()->check() )
                            @if( ! Auth::user()->loved( $product->id ) )
                            <a href="#" class="save-to-favorite" data-id="{{ $product->id }}"><i class="far fa-heart"></i> Lưu tin</a>
                            @else
                             <a href="#" class="save-to-favorite" data-id="{{ $product->id }}"><i class="fas fa-heart"></i> Đã Lưu</a>
                            @endif
                            <a href="#comment-area"  class="scroll-to"><i class="far fa-comments"></i> Bình luận</a>
                        @endif
                        <span><i class="fas fa-user-clock"></i> Đã Xem: {{ $product->viewed }}</span>
                    </div>

                    <div class="product-content">
                        {!! $product->description  !!}
                    </div>

                    
                    @if( auth()->check() )
                    <div id="comment-area"  data-product="{{ $product->id }}" data-user='{{ auth()->user() }}'class="product-comments mb-4"></div>
                    @else
                    <div id="comment-area"  data-product="{{ $product->id }}" class="product-comments mb-4"></div>
                    @endif
                   


                </div>
            </div>
        </div>


        @php
            $postUser = $user->products()
                ->where('id','<>', $product->id)
                ->orderBy('created_at','DESC')
                ->limit(10)
                ->get();
        @endphp

        @if($postUser)
            <div class="mb-4">
                <h2>Bài viết khác của <strong>{{ $user->user_name }}</strong></h2>
                {!! view('blocks.post_carousel',['posts' => $postUser ])->render() !!}
            </div>
        @endif

        @if(  Auth::check() && $recents = Auth::user()->recent()->where( 'product_id', '<>', $product->id )->get() )
            @if( count($recents))
            <div>
                <h3>Đã xem gần đây</h3>
                {!! view('blocks.recent_view',['recents' => $recents])->render() !!}
            </div>
            @endif
        @endif



    </div>
@endsection

@section('footer')
    <script>
        $(function(){
            $('#product-slider').slick({
//                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                centerMode: true,
                variableWidth: true,
                prevArrow: '<a class="slick-prev"><i class="fas fa-chevron-left"></i></a>',
                nextArrow: '<a class="slick-next"><i class="fas fa-chevron-right"></i></a>'
            });

            $('.popup-image').magnificPopup({
                type: 'image',

                gallery:{
                    enabled:true
                },
                mainClass: 'mfp-with-zoom', // this class is for CSS animation below
                zoom: {
                    enabled: true, // By default it's false, so don't forget to enable it

                    duration: 300, // duration of the effect, in milliseconds
                    easing: 'ease-in-out', // CSS transition easing function

                    // The "opener" function should return the element from which popup will be zoomed in
                    // and to which popup will be scaled down
                    // By defailt it looks for an image tag:
                    opener: function(openerElement) {
                        // openerElement is the element on which popup was initialized, in this case its <a> tag
                        // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                }
            });




            $('#user-post-related').owlCarousel({
                loop: true,
                margin: 30,
                items: 3,
                autoplay: true,
                responsiveClass: true,
                responsive:{
                    0:{
                        items: 1,
                        nav:true
                    },
                    600:{
                        items: 2,
                        nav:false
                    },
                    1000:{
                        items: 3,
                        nav:true,
                        loop:false
                    }
                }
            });



        });


    </script>
@endsection