
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('blog.blog')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('blog.store') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">

                    <div class="form-group">
                        <label for="">{{ trans('blog.blog_title') }}</label>
                        <input type="text" name="blog_title" required class="form-control" value="{{ old('blog_title' ) }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ trans('blog.blog_slug') }}</label>
                        <input type="text" name="blog_slug" readonly class="form-control" value="{{ old('blog_slug' ) }}">
                    </div>

                    <div class="form-group">
                        <label for="">{{ trans('blog.blog_excerpt') }}</label>
                        <textarea id="" name="blog_excerpt" id="" class="form-control" cols="30" rows="10">{{ old('blog_excerpt' ) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('blog.blog_content') }}</label>
                        <textarea id="" name="blog_content" id="" class="form-control editor" cols="30" rows="10">{{ old('blog_content' ) }}</textarea>
                    </div>

                    <hr>
                    <div class="form-group">
                        <label for="">{{ trans('app.meta_title') }}</label>
                        <input type="text" name="meta_title"  class="form-control" value="{{ old('meta_title' ) }}">
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('app.meta_keyword') }}</label>
                        <input type="text" name="meta_keyword"  class="form-control" value="{{ old('meta_keyword' ) }}">
                    </div>
                    <div class="form-group">
                        <label for="">{{ trans('app.meta_description') }}</label>
                        <textarea name="meta_description"  class="form-control">{{ old('meta_description' ) }}</textarea>
                    </div>


                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <div class="box-header"><label for="">{{ trans('blog.category') }}</label></div>
                        <div class="box-body">
                            <div class="form-group">
                                 {!! \App\Utils\Category::renderCheckbox( $cats ) !!}

                            </div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header"><label for="">{{ trans('blog.blog_thumbnail') }}</label></div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="select-single-image">
                                    <div class="img-item">
                                        <img id="blog-thumbnail-review" class="img-responsive" src="{{ old('blog_thumbnail') }}" alt="">
                                        <input type="hidden" value="{{ old('image') }}" name="blog_thumbnail" id="blog-thumbnail" class="form-control ">
                                    </div>
                                    <a id="select-single-image" 
                                        data-input="blog-thumbnail" 
                                        data-preview="blog-thumbnail-review"  href="#">Select Image</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">{{ trans('app.published') }}</div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">{{ trans('app.status') }}</label>
                                <select name="blog_status" id="" class="form-control">
                                    <option value="1">{{ trans('app.show') }}</option>
                                    <option value="0">{{ trans('app.hide') }}</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary btn-block" name="submit">
                                    <i class="fa fa-save"></i> {{ trans('app.save') }}</button>
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
        $(function(){
            $('#select-single-image').filemanager('image');
        })
 
    </script>
@stop