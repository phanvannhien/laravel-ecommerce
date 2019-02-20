@extends('admin.layouts.app')

@section('content')
    @php
        $services = Config::get('transaction.services');
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
                    <div class="box-header">Lịch sử ví</div>
                    <div class="box-body">
                        <form action="" method="get" class="">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="service" id="">
                                            <option value="">Loại giao dịch</option>
                                            @foreach( $services as $key => $service )
                                                <option {{ Request::get('service') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $service }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <select class="form-control" name="status" id="">
                                            <option value="">Trạng thái</option>
                                            @foreach( $status as $key => $text )
                                                <option {{ Request::get('status') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $text['text'] }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" name="filter" class="btn btn-info"><i class="fa fa-search"></i> Tìm</button>
                                </div>

                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Loại giao dịch</th>
                                    <th>Số điểm</th>
                                    <th>Trạng thái</th>
                                    <th>Ghi chú</th>
                                    <th>Ngày/tháng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach( $wallet as $item )
                                    <tr>
                                        <td class="font-weight-medium">
                                            {{ $services[$item->service] }}
                                        </td>
                                        <td class=" text-danger">{{ $item->getMoneyText() }}</td>
                                        <td>
                                            {!! $item->status !!}
                                        </td>
                                        <td>{{ $item->note }}</td>
                                        <td>
                                            {{ $item->created_at }}
                                        </td>
                                    </tr>
                                    @php
                                        $total = $total + $item->money;
                                    @endphp
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4">Tổng cộng: <span class="text-danger">{{ number_format($total) }}</span></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mt-3 pull-right">
                            {!! $wallet->appends(request()->input())->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

@stop
