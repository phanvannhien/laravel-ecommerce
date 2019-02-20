<div class="row">
    <div class="col-md-7">
        <div id="p-g">
            @foreach( $product->galleries as $gallery )
                <img src="{!! $gallery->image_url !!}" class="img-fluid" alt="">

            @endforeach
        </div>
    </div>
    <div class="col-md-5">
        <h4 class="mb-3">{{ $product->title }}</h4>
        <div id="p-g-thumb" class="mb-4">
            @foreach( $product->galleries as $gallery )
                <img src="{!! $gallery->image_url !!}" class="img-fluid" alt="">
            @endforeach
        </div>
        <p>
            @if( $product->sale_price != 0 || $product->sale_price != '' )
                <strong class="price text-lg">{{ number_format($product->sale_price) }}đ</strong> <br>
                <dl class="row">
                    <dt class="col-sm-4">Giảm: </dt>
                    <dd class="col-sm-8"><span class="text-warning">{{ 100 - round($product->sale_price/$product->price*100) }}%</span></dd>
                    <dt class="col-sm-4">Giá gốc:</dt>
                    <dd class="col-sm-8">{{ number_format($product->price) }}đ</dd>
                </dl>

            @else
                <strong class="price">{{ number_format($product->price) }}đ</strong> <br>
            @endif

        </p>

        <p>Mua ngay tại cửa hàng <img src="{{ url('images/logo-small.png') }}" alt=""></p>

    </div>
</div>

<script>

    $('#p-g').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        centerMode: true,
        centerPadding: '0',
        autoplay: true,
        autoplaySpeed: 2000,
        fade: true,
        asNavFor: '#p-g-thumb',
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-right"></button>',
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-left"></button>',
    });

    $('#p-g-thumb').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '#p-g',
        focusOnSelect: true,
        autoplay: true,
        autoplaySpeed: 2000,
        nextArrow: '<button class="slick-next"><i class="fa fa-angle-right"></button>',
        prevArrow: '<button class="slick-prev"><i class="fa fa-angle-left"></button>',

    });



</script>