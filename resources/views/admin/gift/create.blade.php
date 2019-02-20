
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Quà tặng</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('gift.store') }}" class="">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" class="form-control"
                                       name="title" id="title" value="{{ old('title') }}" required/>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">


                    <div class="box">
                        <div class="box-header"><label for="">Ảnh đại diện</label></div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="select-single-file">
                                    <div class="img-item">
                                        <img width="" class="img-responsive" src="{{ old('image') }}" alt="">
                                        <input type="hidden" value="{{ old('image') }}" name="image" id="" class="form-control ">
                                    </div>
                                    <a href="#">Select Image</a>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                <a href="{{ route('gift.index') }}" class="btn btn-info btn-block btn-lg ">
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
@include('ckfinder::setup')

@section('footer')
    <script>
        function selectFileWithCKFinder( elementId ) {
            CKFinder.popup( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        console.log( file );
                        var img = jQuery( elementId ).find('img');
                        var fileinput = jQuery( elementId ).find('input[name="image"]');
                        $(img).attr('src', file.getUrl() );
                        $( fileinput ).val( file.getUrl() );

                    } );

                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        var output = document.getElementById( elementId );
                        output.value = evt.data.resizedUrl;
                    } );
                }
            } );
        }

        $('.select-single-file').on('click', function(){
            selectFileWithCKFinder( this );
        });

        $(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

        });

    </script>
@stop
