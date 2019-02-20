@extends('admin.layouts.app')

@section('content')
    @php
    $program = Config::get('voucher.program')
    @endphp
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Voucher <a class="btn btn-success" href="{{ route('voucher.create') }}"><i class="fa fa-plus"></i> Tạo Voucher mới</a></h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <form action="" class="form-inline">
            <div class="form-group">

                <input type="text" name="voucher" value="{{ Request::get('voucher') }}" class="form-control" placeholder="Mã voucher">
            </div>
           
            <div class="form-group">
                <select name="is_use" class="form-control" id="">
                    <option value="">Tât cả trạng thái</option>
                    <option {{ Request::get('is_use') == 1  ? 'selected' : '' }} value="1">Đã trúng</option>
                    <option {{ (Request::has('is_use') && Request::get('is_use') == '0') ? 'selected' : '' }} value="0">Chưa trúng</option>
                </select>

            </div>

            <button type="submit" value="filter" name="filter"
                    class="btn btn-primary"><i class="fa fa-search"></i> {{ trans('app.filter') }}</button>
        </form>
        <p>

        </p>
        <form action="{{ route('voucher.grid') }}" method="post">
            @csrf
        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <a href="#" class="btn btn-danger btn-sm to-trash">
                    <i class="fa fa-trash-o"></i> Xoá</a>

                <a href="{{route('voucher.import')}}" class="btn btn-info btn-sm"><i class="fa fa-upload"></i> Import</a>
                <button class="btn btn-success btn-sm" type="submit"
                        name="action" value="export_all"><i class="fa fa-download"></i> Export All</button>

                <button class="btn btn-success btn-sm" type="submit"
                        name="action" value="export_selected"><i class="fa fa-download"></i> Export Selected</button>

            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>

                            <input type="checkbox" name="ids[]" class="i-checks check-all">

                        </td>
                        <td>Mã Voucher</td>
                        <td>Tên chương trình</td>
                        <td>Giá trị</td>
                        <td>Tình trạng</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )
                        <tr>
                            <td>
                                @if( !$item->is_use )
                                <input type="checkbox" class="data-id i-checks" name="id[]" value="{{ $item->id }}">
                                @endif
                            <td>
                                <a href="#">{{ $item->voucher }}</a>
                            </td>
                            <td>{{ $item->program }}</td>
                            <td>{{ number_format($item->voucher_value) }}</td>
                            <td>{!! $item->getStatus() !!}</td>
                            <td>

                                <div class="btn-group">
                                    @if( !$item->is_use )
                                    <a href="{{ route('voucher.edit', $item->id ) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>
                                    @endif

                                </div>

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
        </form>
        <div class="text-center">
            {!! $data->appends(request()->input())->links() !!}
        </div>
    </section>
    <!-- /.content -->

@stop

@section('footer')
    <script>
        $(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
            $('.check-all').on('ifToggled', function(e){
                $('.data-id').iCheck('toggle');
            });
        });

        $('.to-trash').on('click', function(e){
            e.preventDefault();
            var ids = $('.data-id:checked').map(function(){
                return $(this).val();
            });

            if( ids.length <= 0 ){
                swal("Thông báo!", "Chọn dữ liệu để xoá", "warning");
                return false;
            }

            $.ajax({
                url: '{{ route("voucher.remove") }}' ,
                type: 'POST',
                data: { id: ids.get() },
                beforeSend: function(){
                },
                success: function( res ){
                    if( res.success ){
                        swal({
                            title: "@lang('global.success')",
                            text: "@lang('global.success')",
                            type: "success",

                        }, function(){
                            window.location.reload();
                        });

                    }else{

                        swal("Thông báo!", res.msg , "error");
                    }

                }
            });

        })
    </script>
@stop