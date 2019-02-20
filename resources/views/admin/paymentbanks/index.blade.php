@extends('admin.layouts.app')



@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Ngân hàng
            <a href="{{ route('payment_banks.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Thêm mới ngân hàng</a></h1>
    </section>

    <!-- Main content -->
    <section class="content">


        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Tên ngân hàng</td>
                        <td>Chủ tài khoản</td>
                        <td>Số tài khoản</td>
                        <td>Chi nhánh</td>
                        <td>Trạng thái</td>
                        <td>Chức năng</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )

                        <tr>
                            <td><a href="#">{{ $item->payment_bank_name }}</a></td>
                            <td>{{ $item->payment_bank_acc_name }}</td>
                            <td>{{ $item->payment_bank_acc_number }}</td>
                            <td>{{ $item->payment_bank_acc_address }}</td>
                            <td>
                                {!! $item->getStatusText() !!}
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('payment_banks.edit', $item->payment_bank_id ) }}" class="btn btn-sm btn-info pull-right">
                                        <i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <div class="box-footer text-center">
                        <div class="clearfix">
                            @if( $data && count($data))
                                <p class="text-right">@lang('app.showing') {{$data->firstItem()}}-{{$data->lastItem()}} @lang('app.of') {{$data->total()}}
                                    @lang('app.results')</p>
                            @endif
                        </div>

                    </div>
                </table>
            </div>

        </div>
        <!-- /.box -->
        <div class="text-center">
            {!! $data->appends(request()->input())->links() !!}
        </div>
    </section>
    <!-- /.content -->

@stop
