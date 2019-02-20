
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tạo nhóm thành viên</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form method="POST" action="{{ route('role.store') }}" id="level-form" class="">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="name">Tên nhóm</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="display_name">Tên hiển thị <span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="display_name" id="display_name" value="{{ old('display_name') }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="description">Mô tả<span class="text-red">*</span></label>
                                <textarea name="description" id="" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <div class="box-body">

                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-block btn-success">
                                    <i class="fa fa-save"></i> LƯU LẠI
                                </button>

                            </div>
                            <div class="form-group">
                                <a href="{{ route('role.index') }}" class="btn btn-info btn-block btn-lg ">
                                    <i class="fa fa-mail-reply"></i> Quay lại</a>
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
