
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Sản phẩm <a href="{{ route('product.create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i> Tạo mới</a></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('product.update', $product->id ) }}" class="">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" class="form-control"
                                       name="title" id="title" value="{{ $product->title }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="">Giá</label>
                                <input type="text" class="form-control"
                                       name="price" id="price" value="{{ $product->price }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="">Giá giảm</label>
                                <input type="text" class="form-control"
                                       name="sale_price" id="sale_price" value="{{ $product->sale_price }}"/>
                            </div>

                            <div class="form-group">
                                <label for="is_new">Sản phẩm mới
                                    <input {{ ($product->is_new) ? 'checked':'' }} type="checkbox" id="is_new" name="is_new" value="1">
                                </label>
                            </div>


                            <div class="form-group">
                                <label for="is_sale_total">Sản phẩm bán cho đơn hàng 700k
                                    <input {{ ($product->is_sale_total) ? 'checked':'' }}
                                           type="checkbox"
                                           id="is_sale_total"
                                           name="is_sale_total" value="1">

                                </label>
                            </div>

                            <div class="form-group">
                                <label for="">Mô tả ngắn</label>
                                <input type="text" class="form-control"
                                       name="sort_description" id="sort_description" value="{{$product->sort_description }}"/>
                            </div>

                            <div class="form-group">
                                <label for="">Link</label>
                                <input type="text" class="form-control"
                                       name="link" id="link" value="{{ $product->link }}"/>
                            </div>



                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header"><label for="">Ảnh thư viện</label></div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="select-gallery-file">
                                    <div class="img-item">
                                        <img width="" class="img-responsive" src="{{ old('gallery') }}" alt="">
                                        <input type="hidden" value="{{ old('gallery') }}" name="gallery" id="" class="form-control ">
                                    </div>
                                    <a href="#" class="btn btn-success"><i class="fa fa-image"></i> Select Image</a>
                                </div>
                            </div>
                            <div id="galleries" class="">
                                @foreach( $product->galleries as $img )
                                    <div class="text-center col-sm-3">
                                        <img width="100" src="{{$img->image_url}}">
                                        <input type="hidden" name="galleries[]" value="{!! $img->image_url !!}">
                                        <p><a onclick="$(this).closest('div').remove() ">Remove</a></p>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-sm-3">

                    <div class="box">
                        <div class="box-header"><label for="">Chuyên mục</label></div>
                        <div class="box-body">
                            {!! \App\Utils\Category::renderCheckbox( $cats, $product->categories()->pluck('category_id')->toArray() ) !!}
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header"><label for="">Ảnh đại diện</label></div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="select-single-file">
                                    <div class="img-item">
                                        <img width="" class="img-responsive" src="{{ $product->image }}" alt="">
                                        <input type="hidden" value="{{ $product->image }}" name="image" id="" class="form-control ">
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

                                    <option {{ ($product->status == 1) ? 'selected' : '' }} value="1">Hoạt động</option>
                                    <option {{ ($product->status == 0) ? 'selected' : '' }} value="0">Khoá hoạt động</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-block btn-success">
                                    <i class="fa fa-save"></i> LƯU LẠI
                                </button>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('product.index') }}" class="btn btn-info btn-block btn-lg ">
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

        $('.select-gallery-file').on('click', function(){
            CKFinder.popup( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files;

                        evt.data.files.forEach( function( file ) {
                            var item = '<div class="text-center col-sm-3">' +
                                '<img width="100" src="'+file.getUrl()+'" />' +
                                '<input type="hidden" name="galleries[]" value="'+ file.getUrl()+'">' +
                                '<a onclick="$(this).closest(\'div\').remove() ">Remove<a>' +
                                '</div>';

                            $('#galleries').append(item);

                        } );


                    } );

                }
            } );
        });



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
