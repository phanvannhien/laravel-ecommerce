@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('investor.investor')
            <a href="{{ route('investor.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> @lang('app.create')</a></h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>@lang('investor.investor_name')</td>
                            <td>@lang('investor.investor_logo')</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )
                        <tr>
                            <td>
                                <a href="#">{{ $item->brand_name }}</a>
                                <div class="btn-group">
                                    <a href="{{ route('investor.edit', $item->id ) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>
                                </div>
                            </td>
                            <td>
                                <img src="{{ $item->brand_logo }}" width="120" alt="">
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
