
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tạo gói bậc thành viên</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('category.store') }}" class="">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">

                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    @foreach( LaravelLocalization::getSupportedLocales() as $key => $lang )
                                        <li class="{{ ( $key == LaravelLocalization::getCurrentLocale() ) ? 'active' :'' }}">
                                            <a href="#tab_{{ $key }}" data-toggle="tab">{{ $lang['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach( LaravelLocalization::getSupportedLocales() as $key => $lang )
                                        <div class="tab-pane {{ ( $key == LaravelLocalization::getCurrentLocale() ) ? 'active' :'' }}"
                                             id="tab_{{ $key }}">
                                            <div class="form-group">
                                                <label for="">@lang('category.category_name')</label>
                                                <input type="text" class="form-control"
                                                       name="category_name_{{$key}}" id="category_name_{{$key}}" value="{{ old('category_name_'.$key ) }}" required/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

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
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Khoá hoạt động</option>
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
