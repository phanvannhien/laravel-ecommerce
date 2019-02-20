@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('admin.user') </h1>
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
                    <div class="box-header">Ngân hàng thành viên</div>
                    <div class="box-body">
                        <form class="frm-update-bank" action="{{ route('admin.user.banks.update', ['user_id' => $bank->user_id, 'bank_id' => $bank->user_bank_id ] ) }}" method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="">Ngân hàng</label>
                                <input type="text" class="form-control" name="bank_name" value="{{ $bank->bank_name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Tên tài khoản</label>
                                <input name="bank_full_name" type="text" class="form-control" id="" value="{{ $bank->bank_full_name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Số tài khoản</label>
                                <input name="bank_acc_number" type="text" class="form-control" id="" value="{{ $bank->bank_acc_number }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Chi nhánh</label>
                                <input name="bank_location" type="text" class="form-control" id="" value="{{ $bank->bank_location }}" required>
                            </div>

                            <div class="form-group">
                                <label for="">SWIFT Code</label>
                                <input name="bank_swift_code" type="text" class="form-control" id="" value="{{ $bank->bank_swift_code }}">
                            </div>

                            <div class="form-group">
                                <label for="">Khoá sửa thông tin</label>
                                <select name="locked" id="" class="form-control">
                                    <option {{ ($bank->locked == 0) ? 'selected' : '' }} value="0">Mở Khoá</option>
                                    <option {{ ($bank->locked == 1) ? 'selected' : '' }} value="1">Khoá</option>
                                </select>
                            </div>


                            <button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i> Lưu</button>

                            <a href="{{ route('admin.user.banks', ['user_id' => $user->id ]) }}" class="btn btn-sm btn-danger">
                                <i class="fa fa-bank "></i> Ngân hàng
                            </a>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

@stop
