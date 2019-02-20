@extends('admin.layouts.app')

@section('content')
    @php
        $services = Config::get('transaction.client');
        $status = Config::get('transaction.status');
    @endphp
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
                    <div class="box-header">Lịch sử giao dịch</div>
                    <div class="box-body">
                        <form action="" method="get" class="">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="user_action" id="">
                                            <option value="">Loại giao dịch</option>
                                            @foreach( $services as $key => $service )
                                                <option {{ Request::get('user_action') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $service }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="status" id="">
                                        <option value="">Trạng thái</option>
                                        @foreach( $status as $key => $text )
                                            <option {{ Request::get('status') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $text['text'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <button type="submit" name="filter" class="btn btn-info"><i class="fa fa-search"></i> Tìm</button>
                                </div>

                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>Mã giao dịch</td>
                                    <td>Lệnh thực hiện</td>
                                    <td>Đến Thành viên</td>
                                    <td>Số tiền</td>
                                    <td>Loại giao dịch</td>
                                    <td>Trạng thái</td>
                                    <td></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $transaction as $item )

                                    <tr>
                                        <td><a href="#">{{ $item->transaction_id }}</a></td>
                                        <td>{!! $item->getUserAction() !!}</td>

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

                            </table>
                        </div>
                        <div class="box-footer text-center">
                            <div class="clearfix">
                                @if( $transaction && count($transaction))
                                    <p class="text-right">@lang('app.showing') {{$transaction->firstItem()}}-{{$transaction->lastItem()}}
                                        @lang('app.of') {{$transaction->total()}}
                                        @lang('app.results')</p>
                                @endif
                            </div>

                        </div>

                        <div class="mt-3 pull-right">
                            {!! $transaction->appends(request()->input())->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

@stop
