<div id="modal-login" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Đăng nhập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('login') }}" id="frm-login">
                    <div id="alert"></div>
                    <div class="form-group">
                        <input name="phone" type="tel" class="form-control" placeholder="Số điện thoại" required>
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" class="form-control" placeholder="Mật khẩu" required>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <p>
                                <a class="text-gray" href="{{ route('password.request') }}">Quên mật khẩu?</a><br>
                                Bạn chưa có tài khoản, <a class="text-success" href="#" data-dismiss="modal"
                                   data-toggle="modal"
                                   data-target="#modal-register">Đăng ký</a>
                            </p>
                        </div>
                        <div class="col-sm-5">
                            <button id="btn-login" class="btn btn-success btn-block radius-sm">Đăng nhập</button>
                        </div>
                    </div>
                </form>
                <hr>
                @include('popup.social')

            </div>




        </div>
    </div>
</div>