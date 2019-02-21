@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('shipping.shipping')</h1>
    </section>

    <!-- Main content -->
    <section class="content">


        @foreach( $shippings as $shipping )

            @php
                $fields = json_decode($shipping->fields);
                $locale = app()->getLocale();
                $extracts = json_decode( $shipping->extracts );
            @endphp
            <div class="panel box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $shipping['code'] }}">
                            {{ $fields->title->$locale }}
                        </a>



                    </h4>
                </div>
                <div id="collapse{{ $shipping['code'] }}" class="panel-collapse collapse">
                    <div class="box-body">
                        <p> Status: {!! $shipping->getStatus() !!}</p>

                        @if( $extracts )
                            @foreach($extracts as $key => $val)
                                <table class="table table-striped">
                                    <tbody>
                                    <tr>
                                        <td width="200">{{ strtoupper($key) }}</td>
                                        <td>
                                            {{ $val }}
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            @endforeach
                        @endif

                    </div>
                    <div class="box-footer">
                        <a href="{{ route('shipping.edit', $shipping->id ) }}" class="btn btn-success pull-right">
                            <i class="fa fa-config"></i> @lang('app.config')</a>
                    </div>
                </div>
            </div>


        @endforeach



    </section>
    <!-- /.content -->

@stop
