@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('country.country') }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form action="" class="form-inline">
            <div class="form-group">
                <input type="text" name="value" value="{{ Request::get('value') }}" class="form-control">
            </div>
            <button type="submit" value="filter" name="filter" class="btn btn-primary"><i class="fa fa-search"></i> {{ trans('app.filter') }}</button>
        </form>
        <hr>


        <!-- Default box -->
        <div class="box">

            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>{{ trans('country.country_code') }}</td>
                        <td>{{ trans('country.name') }}</td>
                        <td>{{ trans('country.native') }}</td>
                        <td>{{ trans('country.phone') }}</td>
                        <td>{{ trans('country.continent') }}</td>
                        <td>{{ trans('country.capital') }}</td>
                        <td>{{ trans('country.currency') }}</td>
                        <td>{{ trans('country.languages') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )
                        <tr>
                            <td>
                                {!! $item->country_code !!}
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->native }}
                            </td>
                            <td>
                                {{ $item->phone }}
                            </td>
                            <td>
                                {{ $item->continent }}
                            </td>
                            <td>
                                {{ $item->capital }}
                            </td>
                            <td>
                                {{ $item->currency }}
                            </td>
                            <td>
                                {{ $item->languages }}
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