<div class="post-item bg-white p-3 mb-3">
    <div class="price">{{ App\Helpers\Price::convert_vietnamese( $post->price ) }}</div>
    <div class="row align-items-stretch justify-content-center">
        <div class="col-3 col-sm-3">
            <figure class="m-0">
                <a title="{{ $post->title }}" href="{{ route('product.detail', [ 'slug' => $post->slug,'id' => $post->id ]) }}">
                    <img src="{!! $post->getThumbnail() !!}" alt="" class="img-thumbnail">
                </a>
            </figure>
        </div>
        <div class="col-9 col-sm-9">
            <div class="post">
                <h4 class="post-name">
                    <a title="{{ $post->title }}" href="{{ route('product.detail', [ 'slug' => $post->slug,'id' => $post->id ]) }}">
                        {{ Str::words($post->title,8 ) }}
                    </a>
                </h4>
                <p class="mb-0 text-black-50">
                    <span><i class="far fa-heart"></i> {{ $post->loves->count() }}</span>
                    <span><i class="far fa-comments"></i> {{ $post->comments->count() }}</span>
                    <span><i class="fas fa-user-clock"></i> Đã Xem {{ $post->viewed }}</span>
                </p>
                <p class="post-address mb-2">{{ $post->getFullAddress() }}</p>

                <p class="mb-0"><a href="{{ route('member.show', $post->user->user_name ) }}">
                        <img src="{{ $post->user->getAvatar() }}" width="24" class="post-u-avatar img-thumbnail rounded-circle p-0 mr-1" alt="">
                        {{ $post->user->user_name }}</a>
                    <small><i class="far fa-time"></i> {{ App\Helpers\Timer::time_elapsed_string( $post->created_at ) }}</small></p>


            </div>
        </div>
    </div>
</div>
