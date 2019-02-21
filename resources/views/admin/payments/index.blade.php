@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Payments</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    @foreach( $payments as $payment )


                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $payment['code'] }}">
                                    {{ $payment['title'][ app()->getLocale() ] }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{{ $payment['code'] }}" class="panel-collapse collapse">
                            <div class="box-body">
                                @foreach($payment as $key => $val)
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td width="200">{{ strtoupper($key) }}</td>
                                            <td>
                                                @if( is_array( $val ) )
                                                    @if( $key == 'title' )
                                                        {{ $val[app()->getLocale()] }}
                                                    @elseif( $key == 'banks' )
                                                        @foreach( $val as $banks )
                                                            <div class="alert alert-success">
                                                            @foreach( $banks as $k => $v )
                                                            <p>{{ strtoupper($k) }}: {{ $v }}</p>
                                                            @endforeach
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @else
                                                    {{ $val }}
                                                @endif
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->

@stop
