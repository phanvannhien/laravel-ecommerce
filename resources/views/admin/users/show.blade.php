@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('admin.user') </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('admin.users.partials.nav')
        <div class="row">
            <div class="col-sm-3">
                @include('admin.users.partials.sidebar')
            </div>

            <div class="col-md-9">
                <div class="box">

                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

@stop
