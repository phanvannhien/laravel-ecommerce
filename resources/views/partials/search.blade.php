<form action="{{ route('search') }}" method="post" class="clearfix p-3 bg-white ">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <select id="sl-real-cats" name="category" class="form-control select2 ">
                    @if( isset($category) )
                        {!! App\Utils\Category::renderSelect( App\Category::get(), $category->id ) !!}
                    @else
                        {!! App\Utils\Category::renderSelect( App\Category::get() ) !!}
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select id="sl-cities" name="matp" class="form-control select2">
                    <option value="">Tất cả Tỉnh/ Thành</option>
                    @foreach( \App\Models\Cities::select('matp','name')->orderBy('name')->get() as $tp )
                        <?php $selectedCity = isset($requestCity) && $requestCity->matp == $tp->matp ? 'selected' : '' ?>
                        <option {{ $selectedCity }} value="{{ $tp->matp }}">{{ $tp->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select id="sl-district" name="maqh" class="form-control select2">
                    <option value="">Tất cả Quận/ Huyện</option>
                    @if( isset( $requestCity ) )
                        @foreach( \App\Models\District::where('matp', $requestCity->matp )->orderBy('name')->select('maqh','name')->get() as $qh )
                            <option {{ isset($requestDictrict) && $requestDictrict->maqh == $qh->maqh ? 'selected' : '' }}
                                    value="{{ $qh->maqh }}">{{ $qh->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                @if( Request::has('price_range') )
                    <?php
                    $arrPrice = explode(',', Request::get('price_range'));
                    ?>
                    <input name="price_range" id="slider-price" type="text" class="form-control" value=""
                           data-slider-min="100000000" data-slider-max="50000000000"
                           data-slider-step="200000000" data-slider-value="[{{ $arrPrice[0] }},{{ $arrPrice[1] }}]"/> <br>
                    <p class="text-danger text-center"><span id="slider-price-text">{{ number_format($arrPrice[0]) }} - {{ number_format($arrPrice[1]) }}</span></p>
                @else
                    <input name="price_range" id="slider-price" type="text" class="form-control" value=""
                           data-slider-min="100000000" data-slider-max="50000000000"
                           data-slider-step="200000000" data-slider-value="[100000000,6900000000]"/> <br>
                    <p class="text-danger text-center"><span id="slider-price-text">100.000.000 - 6.900.000.000</span></p>

                @endif
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input id="title" type="text" class="form-control" placeholder="Căn hộ Cantavil..." name="title" value="{{ Request::get('title') }}">
            </div>
        </div>
        <div class="col-md-6">
            <button type="" class="btn btn-success float-right">Tìm</button>
        </div>
    </div>



</form>