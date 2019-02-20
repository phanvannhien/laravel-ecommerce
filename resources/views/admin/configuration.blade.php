@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ trans('app.config') }}</h1>
</section>

<!-- Main content -->
<section class="content">




    <!-- Default box -->
    <div class="box">

        <div class="box-body">
             <form action="{{ route('back.configuration.save')}}" method="post">
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
                @foreach($configuration as $config )
                    <div class="form-group">
                        <label for="">{{ $config->label }}</label>
                        @if( $config->type == 'textarea' )
                            <textarea name="config[{{ $config->name }}]" class="form-control textarea editor" id="" cols="30" rows="10">{{ $config->config_value }}</textarea>


                        @elseif ( $config->type == 'email' )
                            <input type="email" name="config[{{ $config->name }}]" class="form-control" value="{{ $config->config_value }}">

                        @else
                            <input type="text" name="config[{{ $config->name }}]" class="form-control" value="{{ $config->config_value }}">

                        @endif

                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Save</button>
             </form>    

        </div>
        

    </div>
    <!-- /.box -->
   
</section>
<!-- /.content -->

@stop