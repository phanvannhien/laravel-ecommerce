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
                        <form id="frm-deposit" action="{{ route('admin.user.transfer.step1', $user->id ) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4 stretch-card ">
                                    <div class="card">
                                        <div class="card-header">
                                            Thông tin chuyển
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="">Số điểm</label>
                                                <input class="form-control" type="text" name="point" value="{{ old('point') }}" placeholder="">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Ghi chú</label>
                                                <textarea class="form-control" name="note" placeholder="">{{ old('note') }}</textarea>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-success btn-block">XÁC NHẬN</button>
                                        </div>
                                    </div>

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
