@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Kích hoạt thành viên </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-body">
                <form class="forms-sample" method="POST" action="{{ route('client.profile.save') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" readonly value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="user_name">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" readonly value="{{ $user->user_name }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone"  value="{{ $user->phone }}">
                    </div>

                    <div class="form-group">
                        <label for="full_name">Tên đầy đủ</label>
                        <input type="text" class="form-control" id="full_name" name="full_name"  value="{{ $user->full_name }}">
                    </div>

                    <div class="form-group">
                        <label for="cmnn">CMNN</label>
                        <input type="text" class="form-control" id="cmnn" name="cmnn"  value="{{ $user->cmnn }}">
                    </div>

                    <?php
                    $carbon = new \Carbon\Carbon($user->dob, 'Asia/Ho_Chi_Minh');

                    ?>
                    <div class="form-group">

                        <div class="row">
                            <div class="col-sm-2">
                                <label for="full_name">Ngày sinh</label>
                                <select class="dob day form-control" name="day" id="">
                                    <option value="">Ngày Sinh</option>
                                    @for( $i = 1; $i <= 31 ; $i++ )
                                        <option {{ $carbon->day == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>

                            </div>
                            <div class="col-sm-2">
                                <label for="full_name">Tháng sinh</label>
                                <select class="dob month form-control" name="month" id="">
                                    <option value="">Tháng Sinh</option>
                                    @for( $i = 1; $i <= 12 ; $i++ )
                                        <option {{ $carbon->month == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>

                            </div>
                            <div class="col-sm-2">
                                <label for="full_name">Năm sinh</label>
                                <select class="dob year form-control" name="year" id="">
                                    <option value="">Năm Sinh</option>
                                    @for( $i = 1900 ; $i <= 2000 ; $i++ )
                                        <option {{ $carbon->year == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>

                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address"  value="{{ $user->address }}">
                    </div>


                    <button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i> Lưu</button>
                    <button class="btn btn-light">Bỏ Qua</button>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->

@stop
