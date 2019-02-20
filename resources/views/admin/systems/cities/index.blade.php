@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ trans('admin.city') }}</h1>
</section>

<!-- Main content -->
<section class="content">

    <form action="" class="form-inline">
        <div class="form-group">
            <input type="text" name="code" value="{{ Request::get('name') }}" class="form-control">
        </div>
        <button type="submit" value="filter" name="filter" class="btn btn-primary"><i class="fa fa-search"></i> {{ trans('admin.filter') }}</button>
    </form>
    <hr>


    <!-- Default box -->
    <div class="box">

        <div class="box-body">
            <table class="table">
                <thead>
                <tr>
                    <td>{{ trans('admin.id') }}</td>
                    <td>{{ trans('admin.name') }}</td>
                    <td>{{ trans('admin.type') }}</td>

                </tr>
                </thead>
                <tbody>
                @foreach( $data as $item )
                <tr>
                    <td>
                        {!! $item->matp !!}
                    </td>
                    <td>
                        {{ $item->name }}
                    </td>
                    <td>
                        {{ $item->type }}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="box-footer text-center">
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