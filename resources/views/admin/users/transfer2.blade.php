@extends('admin.layouts.app')

@section('content')
    @php
        $services = Config::get('transaction.client');
        $status = Config::get('transaction.status');
    @endphp
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Chuyển/ Rút điểm thành viên </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('admin.users.partials.nav')
        <div class="row">
            <div class="col-sm-3">
                @include('admin.users.partials.sidebar')
            </div>

            <div class="col-md-9">
                <div class="box">
                    <div class="box-body">
                        <form id="frm-deposit" action="{{ route('admin.user.transfer.step2.save',['user_id' => $user->user_id, 'transaction_id' => $transaction->transaction_id ]  ) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Số điểm</label>
                                        <input class="form-control input-lg" type="text" name="point" value="{{ $transaction->money }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Mã xác nhận</label>
                                        <input class="form-control input-lg" type="text" name="verify_code" value=""
                                               placeholder="">
                                        <small class="text-danger">Mã xác nhận được gửi tới số điện thoại:
                                            <span class="text-success">{{ Auth::user()->phone }}</span> của bạn, <br>
                                            Không thấy mã? <button class="btn btn-success btn-sm" type="submit" name="submit" value="refresh_code"><i class="fa fa-refresh"></i> Gửi lại mã (Chi phí: 2000T/1 tin nhắn )</button></a></small>
                                        <br>
                                        <small>* Mã xác nhận hiệu lực 3 phút</small>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-success btn-block" value="submit">XÁC NHẬN</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

@stop
