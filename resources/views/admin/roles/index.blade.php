@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Nhóm người dùng
            <a href="{{ route('role.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Tạo nhóm mới</a></h1>
    </section>

    <!-- Main content -->
    <section class="content">


        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>Tên nhóm</td>
                        <td>Mô tả</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )

                        <tr >
                            <td><a href="#">{{ $item->name }}</a></td>
                            <td>{{ $item->display_name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>

                                <div class="btn-group">
                                    <a href="{{ route('role.edit', $item->id ) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <div class="box-footer text-center">
                        <div class="clearfix">
                            @if( $data && count($data))
                                <p class="text-right">@lang('app.showing')
                                        {{$data->firstItem()}}-{{$data->lastItem()}} @lang('app.of') {{$data->total()}}
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
