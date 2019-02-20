@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('menus.create_menu') }}</h1>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-body">
                <form action="{{ route('menus.update', $menu->id ) }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <div class="form-group">
                        <label for="">@lang('menus.menu_code')</label>
                        <input type="text" name="menu_code" class="form-control" value="{{ $menu->menu_code }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">@lang('menus.menu_title')</label>
                        <input type="text" name="menu_title" class="form-control" value="{{ $menu->menu_title }}">
                    </div>
                    <button type="submit" name="submit"  value="" class="btn btn-success">@lang('app.save')</button>
                </form>
            </div>
        </div>


    </section>
    <!-- /.content -->

@stop