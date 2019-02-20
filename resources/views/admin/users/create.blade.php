
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>Tạo thành viên mới</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form method="POST" action="{{ route('user.store') }}" id="signup-form" class="signup-form">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">
                            <h3>Thông tin cá nhân</h3>
                            <div class="form-group">
                                <label for="">Tên của bạn</label>
                                <input type="text" class="form-control" name="full_name" id="name" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label for="">Email <span class="text-red">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="" required/>
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="" required/>
                            </div>
                            <div class="form-group">
                                <label for="">Số CMNN <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="cmnn" id="cmnn" placeholder="" required/>
                            </div>
                            <div class="form-group">
                                <label for="">Giới tính<span class="text-red">*</span></label>
                                <select class="form-control" name="gender" id="">
                                    <option value="male">Nam</option>
                                    <option value="female">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Ngày sinh<span class="text-red">*</span></label>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <select class="dob day form-control" name="day" id="">
                                            <option value="">Ngày</option>
                                            @for( $i = 1; $i <= 31 ; $i++ )
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="dob month form-control" name="month" id="">
                                            <option value="">Tháng</option>
                                            @for( $i = 1; $i <= 12 ; $i++ )
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="dob year form-control" name="year" id="">
                                            <option value="">Năm</option>
                                            @for( $i = 1900 ; $i <= 2000 ; $i++ )
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder=""/>
                            </div>
                            <h3>Thông tin đăng nhập</h3>
                            <div class="form-group">
                                <label for="">Tên đăng nhập<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="user_name" id="user-name" placeholder="" required/>
                            </div>

                            <div class="form-group">
                                <label for="">Mật khẩu<span class="text-red">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="******" required/>

                            </div>
                            <div class="form-group">
                                <label for="">Nhắc lại Mật khẩu<span class="text-red">*</span></label>
                                <input type="password" class="form-control" name="re_password" id="re_password" placeholder="" required/>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Khoá hoạt động</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-block btn-success">
                                    <i class="fa fa-save"></i> LƯU LẠI
                                </button>


                            </div>
                            <div class="form-group">
                                <a href="{{ route('user.index') }}" class="btn btn-info btn-block btn-lg "><i class="fa fa-mail-reply"></i> Quay lại</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </form>

        <!-- /.box -->
    </section>
    <!-- /.content -->

@stop
