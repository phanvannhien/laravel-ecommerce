<h3 class="text-center mb-4 a-title">Sản phẩm ưu đãi shock 70% khi mua bill 700k</h3>

<div class="row">
    @foreach( $products as $pro)
    <div class="col-6 col-md-3 mb-4">

        <div class="product-item">

            <figure>
                <img class="img-fluid" src="{{ $pro->image }}" alt="">
            </figure>
            <h4>{{ $pro->title }}</h4>
            <p class="mb-0">{!! $pro->getPriceDiscount() !!}</p>
        </div>

    </div>
    @endforeach
</div>