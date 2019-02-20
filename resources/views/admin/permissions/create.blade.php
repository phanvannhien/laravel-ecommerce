
@extends('admin.layouts.app')
@php
    $routeCollection = Route::getRoutes();
@endphp
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Hành động của hệ thống</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form method="POST" action="" id="level-form" class="">
            {{ csrf_field() }}


            <div class="box">
                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th width='10%'><h4>Action</h4></th>
                                <th width='10%'><h4>Name</h4></th>
                                <th width='70%'><h4>URI Request</h4></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach( $routeCollection as $route)
                            <tr>

                                <td>{{  $route->getActionName() }}</td>
                                <td>{{  $route->getName() }}</td>
                                <td>{{  $route->uri() }}</td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>



                </div>
            </div>


        </form>

        <!-- /.box -->
    </section>
    <!-- /.content -->

@stop

@section('footer')
    <script>
        $(document).ready(function(){
            $('.colorpicker').colorpicker().on('changeColor', function(e) {
                $(this)[0].style.backgroundColor = e.color.toString('rgba');
            });
        })
    </script>
@stop
