@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('menus.menu') }}</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="panel panel-default">
            <div class="panel-body">
                <form action="" class="form-inline">
                    <label for="">@lang('menus.select_menu')</label>
                    <select name="menu" class="form-control" id="">
                        @foreach( \App\Models\Menus::all() as $menu )
                        <option {{ ( Request::get('menu') == $menu->menu_code ) ? 'selected' : '' }} value="{{ $menu->menu_code }}">{{ $menu->menu_title }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary" value="submit" name="select_menu">@lang('app.select')</button>
                    <a href="{{ route('menus.create') }}" class="btn btn-sm btn-success">@lang('menus.create_menu')</a>
                </form>
                <hr>
                <div id="box-create-menu" class="box collapse {{ ( Request::get('submit_create_menu') ) ? 'in' : '' }}">
                    <div class="box-body">
                        <form action="{{ route('menus.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">@lang('menus.menu_code')</label>
                                <input type="text" name="menu_code" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">@lang('menus.menu_title')</label>
                                <input type="text" name="menu_title" class="form-control">
                            </div>
                            <button type="submit" name="submit_create_menu"  value="" class="btn btn-success">@lang('app.save')</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog category</h3>
                    </div>
                    <div class="box-body slim-scroll">

                    </div>
                </div>
            </div>
            <div class="col-sm-8">

            </div>
        </div>


        <!-- Default box -->
        <div class="box">

            <div class="box-body">


            </div>
            <div class="box-footer text-center">
                <div class="clearfix">

                </div>

            </div>


        </div>
        <!-- /.box -->
        <div class="text-center">

        </div>

    </section>
    <!-- /.content -->

@stop