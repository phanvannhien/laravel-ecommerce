
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tạo gói bậc thành viên</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('category.update', $category->id ) }}" id="" class="">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="category_name">Tên gói</label>
                                <input type="text" class="form-control" name="category_name"
                                       id="category_name" value="{{ $category->category_name }}" required/>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <select name="status" id="" class="form-control">
                                    <option {{ ($category->status == 1) ? 'selected' : '' }} value="1">Hoạt động</option>
                                    <option {{ ($category->status == 0) ? 'selected' : '' }} value="0">Khoá hoạt động</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-block btn-success">
                                    <i class="fa fa-save"></i> LƯU LẠI
                                </button>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('category.index') }}" class="btn btn-info btn-block btn-lg "><i class="fa fa-mail-reply"></i> Quay lại</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





        </form>

        <!-- /.box -->
    </section>
    <!-- /.content -->

@stop

@section('footer')
    <script>
        $(document).ready(function(){
            $('.colorpicker').colorpicker().on('changeColor', function(e) {
                $(this)[0].style.backgroundColor = e.color.toString('rgba');
            });
        })
    </script>
@stop
