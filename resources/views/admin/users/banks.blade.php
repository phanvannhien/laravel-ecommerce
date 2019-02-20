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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Tên Ngân hàng</th>
                                <th>Chủ TK</th>
                                <th>Số TK</th>
                                <th>Chi Nhánh</th>
                                <th>SWIFT Code</th>
                                <td>Khoá</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $banks as $bank )
                                <tr>
                                    <td>{{ $bank->bank_name }}</td>
                                    <td>{{ $bank->bank_full_name }}</td>
                                    <td>{{ $bank->bank_acc_number }}</td>
                                    <td>{{ $bank->bank_location }}</td>
                                    <td>{{ $bank->bank_swift_code }}</td>
                                    <td>{!! $bank->getLocked() !!}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="{{ route('admin.user.banks.edit',[ 'user_id' => $bank->user_id, 'bank_id' => $bank->user_bank_id ]) }}">
                                            Sửa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        {!! $banks->appends(request()->input())->links() !!}
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

@stop
