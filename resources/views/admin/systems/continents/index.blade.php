@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('continent.continent') }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>{{ trans('continent.code') }}</td>
                        <td>{{ trans('continent.name') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )
                        <tr>
                            <td>
                                {!! $item->continent_code !!}
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer ">
                <div class="clearfix">
                    @if( $data && count($data))
                        <p class="text-right">@lang('app.showing') {{$data->firstItem()}}-{{$data->lastItem()}} @lang('app.of') {{$data->total()}}
                            @lang('app.results')</p>
                    @endif
                </div>
            </div>

        </div>
        <!-- /.box -->
        <div class="text-center">
            {!! $data->appends(request()->input())->links() !!}
        </div>
    </section>
    <!-- /.content -->

@stop