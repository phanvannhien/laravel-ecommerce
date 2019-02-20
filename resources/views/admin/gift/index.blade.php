@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quà tặng
            <a href="{{ route('gift.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Tạo mới</a></h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <a href="#" class="btn btn-danger btn-sm to-trash">
                    <i class="fa fa-trash-o"></i> Xoá</a>
            </div>
            <div class="box-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td><input type="checkbox" name="ids[]" class="i-checks check-all"></td>
                        <td>Tên sản phẩm</td>
                        <td>Ảnh</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $data as $item )

                        <tr>
                            <td><input type="checkbox" class="data-id i-checks" name="id[]" value="{{ $item->id }}"></td>
                            <td>
                                <a href="#">{{ $item->title }}</a>
                                <br>
                                <a href="{{ route('gift.edit', $item->id ) }}" class="">
                                        <i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>

                            </td>
                            <td><img src="{{ $item->getImage() }}" width="50" alt=""></td>
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

            swal({
                title: 'Bạn chắc chắn muốn xoá?',
                text: "Bạn không thể phục hồi",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tiếp tục xoá!'
            }, function(){
                var ids = $('.data-id:checked').map(function(){
                    return $(this).val();
                });

                if( ids.length <= 0 ){
                    swal("Thông báo!", "Chọn dữ liệu để xoá", "warning");
                    return false;
                }

                $.ajax({
                    url: '{{ route("product.remove") }}' ,
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
            });



        })
    </script>
@stop