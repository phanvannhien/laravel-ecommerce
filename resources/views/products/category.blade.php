@extends('layouts.app')


@section('main')
    <div class="py-4">
        <div id="search-area" class="mb-4">
            <div class="container">
                @include('partials.search')
            </div>
        </div>
        <div class="container">
            <div class="block">
                        <div class="block-head">
                            <h1>{{ $category->category_name }}

                                @isset( $requestDictrict )
                                {{ $requestDictrict->name }},
                                @endisset

                                @isset( $requestCity )
                                    {{ $requestCity->name }}
                                @endisset

                            </h1>
                        </div>
                        <div class="block-body">
                            <?php $currentURI =  Request::fullUrl() ?>

                            <div id="tool-bars" class="clearfix">
                                <?php
                                    $orderby = [
                                        'title' => [
                                            'asc' => 'Tên A-Z',
                                            'desc' => 'Tên Z-A'
                                        ],
                                        'price' => [
                                            'asc' => 'Giá tăng dần',
                                            'desc' => 'Giá giảm dần'
                                        ],
                                        'created_at' => [
                                            'desc' => 'Mới nhất',
                                            'asc' => 'Cũ nhất'
                                        ],
                                        'viewed' => [
                                            'desc' => 'Xem nhiều'
                                        ],
                                    ];

                                ?>
                                <div class="row justify-content-end">
                                    <div class="col-md-3">
                                        <select class="form-control float-right" name="order" id="" onchange="window.location.href = $(this).val()">
                                            @foreach( $orderby as $key => $val )
                                                @foreach( $val as $dir => $text )
                                                    @php
                                                        $url = url( request()->fullUrlWithQuery([ 'orderby' => $key, 'dir' => $dir ]));
                                                        $selected = ( request()->get('orderby') == $key &&  request()->get('dir') == $dir )
                                                            ? 'selected'
                                                            : '';
                                                    @endphp
                                                    <option {{ $selected }} value="{{ $url }}">{{ $text }}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                                <hr>
                            @include('blocks.post_list')


                        </div>
                    </div>
        </div>

    </div>

@endsection
