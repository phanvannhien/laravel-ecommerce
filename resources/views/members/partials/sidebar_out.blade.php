<div class="user-wrap user-wrap bg-white p-3 rounded shadow-sm">
    <div class="clearfix mb-4">
        <a href="{{ route('member.show', $user->user_name ) }}">
            <figure>
                <img width="70" class="img-thumbnail rounded-circle float-left mr-3" src="{{ $user->getAvatar() }}" alt="">
            </figure>
        </a>
        <p>
            <a href="{{ route('member.show', $user->user_name ) }}">{{ $user->full_name }}</a><br>
            Bài đăng: {{ $user->products->count() }}
        </p>
    </div>

    <p>
        <a href="tel:{{ $user->phone }}"><i class="fas fa-phone-volume"></i> Tel:  {{ $user->phone }}</a><br>
        <a href="mailto:{{ $user->email }}"><i class="far fa-envelope"></i> E: {{ $user->email }}</a><br>
        <i class="far fa-calendar-alt"></i> Tham gia: {{ $user->created_at->format('d-m-Y') }}
    </p>


    <div class="user-actions">



        @if( Auth::check() )
            @if( Auth::user()->id != $user->id )
                <p>
                    <a href="#" class="btn btn-success btn-block"><i class="far fa-comment"></i> Gửi tin nhắn</a>
                </p>
                <?php $status = Auth::user()->getFriendStatus( $user->id ); ?>
                @if( $status && $status->status == 0 )
                    <a href="#" class="btn btn-success btn-block"><i class="far fa-comment"></i> Đã gửi kết bạn</a>
                @elseif( $status &&  $status == 1 )
                    <a href="#" class="btn btn-success btn-block"><i class="far fa-comment"></i> Đã là bạn bè</a>
                @elseif( $status && $status == 3 )
                    <a href="#" class="btn btn-success btn-block"><i class="far fa-comment"></i> Đã bị từ chối</a>
                @else
                    <a href="#" class="btn btn-success btn-block req-add-friend" data-contact="{{ $user->id }}">
                        <i class="far fa-comment"></i> Yêu cầu kết bạn</a>
                @endif
            @endif

        @else
            <div class="alert alert-success"><a href="#" data-toggle="modal" data-target="#modal-login">Đăng nhập</a>
                để liên hệ với {{ $user->user_name }}.</div>
        @endif


    </div>
</div>
