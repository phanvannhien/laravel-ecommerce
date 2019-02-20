@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('app.send_contact') }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>{{ trans('app.your_name') }}</td>
                        <td>{{ trans('app.your_email') }}</td>
                        <td>{{ trans('app.your_subject') }}</td>
                        <td>{{ trans('app.message') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )
                        <tr>
                            <td>
                                {!! $item->name !!}
                            </td>
                            <td>
                                <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                            </td>
                            <td>
                                {!! $item->subject !!}
                            </td>
                            <td>
                                {!! $item->message !!}
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