@extends('admin.layouts.app')



@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Chi Nhánh
            <a href="{{ route('offices.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Thêm mới Chi Nhánh</a></h1>
    </section>

    <!-- Main content -->
    <section class="content">


        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Tên Chi Nhánh</td>
                        <td>Email</td>
                        <td>SDT</td>
                        <td>Địa chỉ</td>
                        <td>Trạng thái</td>
                        <td>Chức năng</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )
                        <tr>
                            <td><a href="#">{{ $item->office_name }}</a></td>
                            <td>{{ $item->office_email }}</td>
                            <td>{{ $item->office_phone }}</td>
                            <td>{{ $item->office_address }}</td>
                            <td>
                                {!! $item->getStatusText() !!}
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('offices.edit', $item->office_id ) }}" class="btn btn-sm btn-info pull-right">
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
