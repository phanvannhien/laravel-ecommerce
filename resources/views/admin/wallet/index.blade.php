@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Thống kê giao dịch</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form action="" method="get" class="">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">

                        <select class="form-control" name="service" id="">
                            <option value="">Tất cả</option>
                            @foreach( $services as $key => $service )
                                <option {{ Request::get('service') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $service }}</option>
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
                    <th>Ngày/tháng</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach( $transaction as $item )
                    <tr>
                        <td class="font-weight-medium">
                            {{ $services[$item->service] }}
                        </td>
                        <td class=" text-danger">{{ $item->getMoneyText() }}</td>
                        <td>
                            {!! $item->status !!}
                        </td>
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
            {!! $transaction->appends(request()->input())->links() !!}
        </div>
    </section>


@stop


