@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Gói thành viên

            <a href="{{ route('package.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Tạo Gói thành viên</a></h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Tên gói</td>
                        <td>Giá gói</td>
                        <td>Màu sắc gói</td>
                        <td>Trạng thái</td>
                        <td>Chức năng</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )

                        <tr>
                            <td><a href="#">{{ $item->package_name }}</a></td>
                            <td><span class="color-palette">{{ number_format($item->package_price) }}</span></td>
                            <td style="background-color: {{ $item->package_color }}">{{ $item->package_color }}</td>
                            <td>
                                {!! $item->getStatusText() !!}
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('package.edit', $item->package_id ) }}" class="btn btn-sm btn-info">
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
