@extends('layouts.app')
@section('main')
    @include('members.partials.top')
    <div id="user-page-container">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-stretch">
                @include('members.partials.sidebar')
                <div id="primary" class="col-md-9">
                    <div id="primary-inner" class="py-4">
                        @include('partials.messages')
                        @include('members.partials.toolbars')
                        <div class="clearfix mt-3">
                            @if( $posts && count($posts))
                                <p class="text-right">@lang('app.showing') {{$posts->firstItem()}}-{{$posts->lastItem()}}
                                    @lang('app.of') {{$posts->total()}}
                                    @lang('app.results')</p>
                            @endif
                        </div>

                        @foreach( $posts as $post )
                            <div class="row align-items-stretch justify-content-center">
                                <div class="col-sm-3">
                                    <figure>
                                        <img src="{!! $post->getThumbnail() !!}" alt="" class="img-thumbnail">
                                    </figure>
                                </div>
                                <div class="col-sm-9">
                                    <div class="post">

                                        <h4>
                                            <a title="{{ $post->title }}" href="{{ route('product.detail',
                                                [ 'slug' => $post->slug,'id' => $post->id ]) }}">
                                                {{ $post->title }}
                                            </a>
                                        </h4>
                                        <p>
                                            Chuyên mục: {!! $post->getCategoriesFront() !!}
                                            <br>
                                            Địa chỉ: {{ $post->getFullAddress() }}
                                        </p>
                                        <p>
                                            <span><i class="far fa-heart"></i> 30</span>
                                            <span><i class="far fa-comments"></i> 20</span>
                                        </p>
                                        <p><a href="{{ route('user.post.edit', [ 'slug' => $post->slug ] ) }}">
                                                <i class="far fa-edit"></i> Sửa </a></p>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="text-right">
                            {!! $posts->appends(request()->input())->links() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection