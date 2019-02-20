<div id="user-slide-menu">
    <a onclick="$(this).parent().attr('class','animated slideOutRight').hide();  $('#app').removeClass('overlay');" href="#" class="float-right btn btn-sm btn-danger">
        <i class="far fa-window-close"></i>
    </a>
    <ul>
        <li><a href="{{ route('user.post') }}"><i class="far fa-list-alt"></i> Bài Đăng </a></li>
        <li><a href="{{ route('user.friends') }}"><i class="fas fa-user-friends"></i> Bạn bè</a></li>
        <li><a href="{{ route('user.block') }}"><i class="fas fa-ban"></i> Chặn</a></li>
        <li><a href="{{ route('user.profile') }}"> <i class="fa fa-cog"></i> Hồ sơ</a></li>
        <li>
            <a href="{{ route('user.favorite') }}">
                <i class="far fa-heart"></i> Danh sách yêu thích
            </a>
        </li>

        <li>
            <a href="#">
                <i class="far fa-user"></i>  Mời bạn bè
            </a>
        </li>
        <li>
            <a href="#">
                <i class="far fa-comments"></i>  Nhận xét đánh giá
            </a>
        </li>

        <li>
            <a href="#">
                <i class="fas fa-question"></i>  Hỗ trợ giúp đỡ
            </a>
        </li>
        <li>
            <a href="{{ route('user.password') }}">
                <i class="fas fa-sign-out-alt"></i>  Đổi mật khẩu
            </a>
        </li>
        <li>
            <a href="{{ route('user.logout') }}">
                <i class="fas fa-sign-out-alt"></i>  Đăng xuất
            </a>
        </li>

    </ul>
</div>