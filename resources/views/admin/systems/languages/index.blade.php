@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('languages.languages') }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>{{ trans('languages.code') }}</td>
                        <td>{{ trans('languages.name') }}</td>
                        <td>{{ trans('languages.active') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )
                        <tr>
                            <td>
                                {!! $item->language_code !!}
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>

                                {!!  ($item->active)
                                    ? '<span class="label label-success">'.trans('app.enabled').'</span>'
                                    : '<span class="label label-danger">'.trans('app.disabled').'</span>' !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
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