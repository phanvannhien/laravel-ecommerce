
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ route('product.index') }}" class="btn btn-info pull-right">
            <i class="fa fa-mail-reply"></i> @lang('app.back')</a>
        <h1>@lang('product.product') <a href="{{ route('product.create') }}" class="btn btn-success">
            <i class="fa fa-plus"></i> @lang('app.create')</a></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('product.store') }}" class="">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="title">@lang('product.title')</label>
                                <input type="text" class="form-control"
                                       name="title" id="title" value="{{ old('title') }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="price">@lang('product.price')</label>
                                <input type="text" class="form-control"
                                       name="price" id="price" value="{{ old('price') }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="sale_price">@lang('product.sale_price')</label>
                                <input type="text" class="form-control"
                                       name="sale_price" id="sale_price" value="{{ old('sale_price') }}"/>
                            </div>

                            <div class="form-group">
                                <label for="is_new">@lang('product.is_new')
                                    <input type="checkbox" id="is_new" name="is_new" value="1">
                                </label>
                            </div>


                            <div class="form-group">
                                <label for="sort_description">@lang('product.sort_description')</label>
                                <input type="text" class="form-control"
                                       name="sort_description" id="sort_description" value="{{ old('sort_description') }}"/>
                            </div>

                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" class="form-control"
                                       name="link" id="link" value="{{ old('link') }}"/>
                            </div>
                            <div class="form-group">
                                <label for="description">@lang('product.description')</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="box">
                        <div class="box-header"><label for="">@lang('product.image')</label></div>
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
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-sm-3">

                    <div class="box">
                        <div class="box-header">@lang('product.type')</div>
                        <div class="box-body">
                            @foreach( App\Models\Type::select('id','type_name')->get() as $item )
                                <label for="i{{ $item->id }}">
                                    <input class="i-checks" id="i{{ $item->id }}" type="checkbox" name="type[]" value="{{ $item->id }}"> {{ $item->type_name }}</label>
                            @endforeach    
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header">@lang('product.category')</div>
                        <div class="box-body">
                            {!! \App\Utils\Category::renderCheckbox( $cats ) !!}
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header">@lang('product.thumbnail')</div>
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
                        <div class="box-header">@lang('app.status')</div>
                        <div class="box-body">
                            <div class="form-group">
                                <select name="status" id="status" class="form-control">
                                    <option value="1">@lang('app.activate')</option>
                                    <option value="0">@lang('app.deactivate')</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-block btn-success">
                                    <i class="fa fa-save"></i> @lang('app.save')
                                </button>
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

        $(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

        });

    </script>
@stop
