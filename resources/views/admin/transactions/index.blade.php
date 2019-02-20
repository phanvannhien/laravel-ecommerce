@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tất cả giao dịch hệ thống</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="" class="form-inline">
            <div class="form-group">
                <input type="text" name="transaction_id" value="{{ Request::get('transaction_id') }}" class="form-control"
                       placeholder="Mã giao dịch">
            </div>
            <div class="form-group">
                <input type="text" name="full_name" value="{{ Request::get('full_name') }}" class="form-control" placeholder="Tên thành viên">
            </div>

            <div class="form-group">
                <input type="text" name="email" value="{{ Request::get('email') }}" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" name="phone" value="{{ Request::get('phone') }}" class="form-control" placeholder="Số điện thoại">
            </div>

            <div class="form-group">
                <input type="text" name="user_id" value="{{ Request::get('user_id') }}" class="form-control" placeholder="Mã thành viên">
            </div>

            <button type="submit" value="filter" name="filter" class="btn btn-primary"><i class="fa fa-search"></i> {{ trans('app.filter') }}</button>
        </form>
        <p> </p>

        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Mã giao dịch</td>
                        <td>Lệnh thực hiện</td>
                        <td>Từ Thành viên</td>
                        <td>Đến Thành viên</td>
                        <td>Số tiền</td>
                        <td>Loại giao dịch</td>
                        <td>Trạng thái</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )

                        <tr>
                            <td><a href="#">{{ $item->transaction_id }}</a></td>
                            <td>{!! $item->getUserAction() !!}</td>
                            <td><a href="{{ route('user.show', $item->user->id ) }}">{{ $item->user->user_name }}</a></td>
                            <td class=" text-danger">
                                @if( $item->user_id == $item->to_user_id )
                                    Ví của bạn
                                @else
                                    <a href="{{ route('user.show', $item->toUser->id ) }}">{{ $item->toUser->user_name }}</a>
                                @endif
                            </td>
                            <td>{!! $item->getMoneyText() !!} </td>
                            <td>{{ $item->getPaymentMethod() }}</td>
                            <td>{!! $item->getStatusText() !!} </td>
                            <td>
                                <a href="{{ route('admin.transaction.show',$item->transaction_id ) }}" class="btn btn-sm btn-success">Xem</a>
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
