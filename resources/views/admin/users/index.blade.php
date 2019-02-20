@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('user.user') </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('user.index') }}" class="form-inline">
            <div class="form-group">
                <input type="text" name="full_name" value="{{ Request::get('full_name') }}" class="form-control" placeholder="@lang('user.full_name')">
            </div>
            <div class="form-group">
                <input type="text" name="email" value="{{ Request::get('email') }}" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" name="phone" value="{{ Request::get('phone') }}" class="form-control" placeholder="Số điện thoại">
            </div>
            <button type="submit" value="filter" name="filter" class="btn btn-primary"><i class="fa fa-search"></i> {{ trans('app.filter') }}</button>
            @csrf
        <!-- Default box -->
        <div class="box">

            <div class="box-header">
                <button class="btn btn-success btn-sm" type="submit"
                        name="action" value="export"><i class="fa fa-download"></i> Export</button>

            </div>
            <div class="box-body">

                <table class="table">
                    <thead>
                    <tr>
                        <td>
                            <input type="checkbox" name="ids[]" class="i-checks check-all">
                        </td>
                        <td>@lang('user.full_name')</td>
                        <td>@lang('user.email')</td>
                        <td>@lang('user.phone')</td>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )
                        <tr>
                            <td>
                                <input type="checkbox" class="data-id i-checks" name="id[]" value="{{ $item->id }}">
                            </td>

                            <td>
                                <a href="#">{{ $item->full_name }}</a>
                            </td>
                            <td>
                                <a href="#">{{ $item->user_name }}</a><br>
                                <a href="{{ route('user.show', $item->id ) }}"> @lang('app.view') </a>
                            </td>
                            <td><a href="maito:{{ $item->email }}">{{ $item->email }}</a></td>
                            <td><a href="tel:{{ $item->phone }}">{{ $item->phone }}</a></td>
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
        </form>
        <!-- /.box -->
        <div class="text-center">
            {!! $data->appends(request()->input())->links() !!}
        </div>
    </section>
    <!-- /.content -->

@stop

@section('footer')
    <script>
        $(document).ready(function(){
            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.check-all').on('ifToggled', function(e){
                $('.data-id').iCheck('toggle');
            });


        })
    </script>
    
@stop
