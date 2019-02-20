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
                        @if( count( $posts ) )
                            <h2>Danh sách yêu thích</h2>

                            <div class="row">
                                @foreach( $posts as $post )

                                <div class="col-md-6">
                                    
                                    @include('blocks.post_item') 
                                    <hr>
                                    <form action="{{ route('user.favorite.remove') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete">
                                        <input type="hidden" name="product_id" value="{{ $post->id }}">
                                        <button type="submit" name="remove" class="btn btn-sm btn-danger float-right">
                                            <i class="far fa-trash-alt"></i> Xoá</button>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                            @if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator )
                                <div class="text-center">
                                    {!! $posts->appends(request()->input())->links() !!}
                                </div>
                            @endif



                        @else
                        <div class="alert alert-info">
                            Bạn chưa có danh sách yêu thích
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
