@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @lang('category.category')
            <a class="btn btn-success btn-sm" href="{{route('categories.index')}}">{{ trans('app.create') }}</a>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-body">
                        <form action="{{ route('categories.store') }}" method="POST">
                            {{ csrf_field() }}
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
                                            <div class="form-group">
                                                <label for="">@lang('category.category_description')</label>
                                                <textarea id="" name="description" id="" class="form-control" cols="30" rows="5">{{ old('description' ) }}</textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="select-single-file">
                                    <label for="">@lang('category.category_image')</label>
                                    <div class="img-item">
                                        <img width="100" src="{{ url('admin/dist/img/default-50x50.gif') }}" alt="">
                                        <input type="hidden" name="image" id="" class="form-control ">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">@lang('category.category_parent')</label>
                                <select name="parent_id" class="form-control" id="">
                                    <option value="0">@lang('app.select')</option>
                                    {!! \App\Utils\Category::renderSelect($data) !!}
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="">@lang('app.status')</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">@lang('app.activate')</option>
                                    <option value="0">@lang('app.deactivate')</option>
                                </select>
                            </div>
                            <button class="btn btn-success" type="submit" name="submit">
                                <i class="fa fa-save"></i> @lang('app.save')</button>


                        </form>

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-body">
                        {!! \App\Utils\Category::renderAdminHtml( $data, 'categories.edit','categories.destroy' ) !!}
                    </div>
                </div>
            </div>
        </div>





    </section>
    <!-- /.content -->

@stop
@include('ckfinder::setup')
@section('footer')
    <script>



        $('.select-single-file').on('click', function(){
            selectFileWithCKFinder( this );
        })


        function selectFileWithCKFinder( elementId ) {
            CKFinder.popup( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
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
    </script>
@stop
