
@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Kích hoạt thành viên</h1>
    </section>

    <!-- Main content -->
    <section class="content">


        <form method="POST" action="{{ route('admin.user.package.active', $user->user_id) }}" id="signup-form" class="signup-form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-3">
                    <div class="small-box bg-aqua" style="background-color: {{ $package->package->package_color }}">
                        <div class="inner">
                            <h3>{{ number_format($package->package->package_price) }}</h3>
                            <p>{{ $package->package->package_name }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>

                    </div>
                </div>
            </div>

        </form>

        <!-- /.box -->
    </section>
    <!-- /.content -->

@stop
