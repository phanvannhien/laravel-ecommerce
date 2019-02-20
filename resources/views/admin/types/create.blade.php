
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ route('type.index') }}" class="btn btn-info pull-right">
            <i class="fa fa-mail-reply"></i> @lang('app.back')</a>
        <h1>@lang('app.create')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('type.store') }}" class="">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">@lang('type.type_name')</label>
                                <input type="text" class="form-control"
                                       name="type_name"
                                       id="type_name"
                                       value="{{ old('type_name') }}" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <div class="box-body">
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

@section('footer')
@stop
