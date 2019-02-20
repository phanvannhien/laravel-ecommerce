
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ route('level.index') }}" class="btn btn-info pull-right"><i class="fa fa-mail-reply"></i> Quay lại</a>
        <h1>Sửa cấp bậc thành viên <a href="{{ route('level.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Tạo cấp thành viên</a></h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <form method="POST" action="{{ route('level.update', $level->level_id ) }}" id="level-form" class="">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="level_name">Tên cấp bậc</label>
                                <input type="text" class="form-control" name="level_name" id="level_name" placeholder="" value="{{ $level->level_name }}"/>
                            </div>
                            <div class="form-group">
                                <label for="">Hạn mức tối thiểu<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="level_target" id="level_target"
                                       placeholder="" value="{{ $level->level_target }}"/>
                            </div>

                            <div class="form-group">
                                <label for="">Hạn mức tối đa<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="level_target_max"
                                       id="level_target_max" value="{{ $level->level_target_max }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="ward_money">Thưởng đạt cấp (T)<span class="text-red">*</span></label>
                                <input type="text" class="form-control" name="ward_money"
                                       id="ward_money" value="{{ $level->ward_money }}" required/>
                            </div>


                            <div class="form-group">
                                <label for="">Màu sắc cấp bậc <span class="text-red">*</span></label>
                                <input style="background-color: {{ $level->level_color }} " type="text" class="form-control colorpicker" value="{{ $level->level_color }}" name="level_color" id="level_color" placeholder="" required/>
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả<span class="text-red">*</span></label>
                                <textarea name="description" id="" class="form-control" cols="30" rows="10">{{ $level->description }}</textarea>
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

                                    <option {{ ($level->status == 1) ? 'selected' : '' }} value="1">Hoạt động</option>
                                    <option {{ ($level->status == 0) ? 'selected' : '' }} value="0">Khoá hoạt động</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-block btn-success">
                                    <i class="fa fa-save"></i> LƯU LẠI
                                </button>

                            </div>
                            <div class="form-group">
                                <a href="{{ route('level.index') }}" class="btn btn-info btn-block btn-lg "><i class="fa fa-mail-reply"></i> Quay lại</a>
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
