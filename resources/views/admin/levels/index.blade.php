@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Cấp thành viên

            <a href="{{ route('level.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Tạo cấp thành viên</a></h1>

    </section>

    <!-- Main content -->
    <section class="content">


        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Tên cấp</td>
                        <td>Mức tiền tối thiểu</td>
                        <td>Mức tiền tối đa</td>
                        <td>Màu sắc cấp</td>
                        <td>Thưởng cấp</td>
                        <td>Trạng thái</td>
                        <td>Chức năng</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )

                        <tr >
                            <td><a href="#">{{ $item->level_name }}</a></td>
                            <td><span class="color-palette">{{ number_format($item->level_target) }}</span></td>
                            <td><span class="color-palette">{{ number_format($item->level_target_max) }}</span></td>
                            <td style="background-color: {{ $item->level_color }}">{{ $item->level_color }}</td>
                            <td>{{ number_format($item->ward_money) }}</td>
                            <td>
                                {!! $item->getStatusText() !!}
                            <td>

                                <div class="btn-group">
                                    <a href="{{ route('level.edit', $item->level_id ) }}" class="btn btn-sm btn-info">
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
