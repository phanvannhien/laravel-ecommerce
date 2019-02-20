@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Đổi mật khẩu</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="box">
                    <div class="box-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin_user.change_password.save', $user->id ) }}">
                            @csrf
                            <div class="form-group required">
                                <label for="InputPasswordCurrent">Mật khẩu cũ <sup class="text-danger"> * </sup> </label>
                                <input type="password" value="{{ old('old_pass') }}" name="old_pass" class="form-control"
                                       id="InputPasswordCurrent" placeholder="******">
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu mới <span class="text-danger">*</span></label>
                                <input name="password"  value="{{ old('password') }}"  type="password" class="form-control"
                                       placeholder="******">
                            </div>
                            <div class="form-group">
                                <label for="">Nhắc lại Mật khẩu <span class="text-danger">*</span></label>
                                <input  value="{{ old('password_confirmation') }}"  name="password_confirmation" type="password"
                                        class="form-control" placeholder="******">
                            </div>
                            <button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i> Lưu</button>
                            <a class="btn btn-light" href="{{ route('admin.dashboard') }}">Bỏ Qua</a>
                        </form>
                    </div>

                </div>

            </div>
        </div>


    </section>
    <!-- /.content -->

@stop
