@php(
    $topUsers = User::withCount('products')->orderBy('products_count', 'desc')->limit(10)->get();
)

<ul class="user-list">
    @foreach( $topUsers as $user )

        <li class="clearfix">
            <a href="{{ route('member.show', $user->user_name ) }}">
                <div class="u-item ">
                    <div class="u-img float-left">
                        <img width="32" class="img-thumbnail rounded-circle" src="{{ $user->getAvatar() }}" alt="">
                    </div>
                    <div class="u-name">{{ $user->user_name }}
                        <span class="badge badge-primary">{{ $user->products_count }}</span></div>

                </div>
            </a>
        </li>

    @endforeach
</ul>