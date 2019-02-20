@extends('admin.layouts.app')

@section('content')
    @php
        $services = Config::get('transaction.client');
        $status = Config::get('transaction.status');
    @endphp
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Chuyển/ Rút điểm thành viên </h1>
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
                    <div class="box-body">
                        <div class="alert alert-success">Chuyển điểm thành công</div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

@stop
