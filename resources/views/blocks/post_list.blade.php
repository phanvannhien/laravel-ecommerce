@if( count($posts) )

    <div class="row">
        @foreach( $posts as $post )
            <div class="col-md-6">
                @include('blocks.post_item')
            </div>
        @endforeach
    </div>
    @if($posts instanceof \Illuminate\Pagination\LengthAwarePaginator )
        <hr>
    <div class="clearfix">
        {!! $posts->appends(request()->input())->links() !!}
    </div>
    @endif


@else

<div class="alert alert-success">
    Không có tin phù hợp
</div>
@endif