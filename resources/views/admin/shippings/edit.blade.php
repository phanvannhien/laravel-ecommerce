
@extends('admin.layouts.app')

@section('content')
    @php
        $fields = json_decode( $data->fields );
        $extracts = json_decode( $data->extracts );
        $lang = app()->getLocale()
    @endphp
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ route('shipping.index') }}" class="btn btn-info pull-right"><i class="fa fa-mail-reply"></i> @lang('app.back')</a>
        <h1>@lang('app.edit') {{ $fields->title->$lang }} </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <form method="POST" action="{{ route('shipping.update', $data->id ) }}" id="" class="">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-sm-9">
                    <div class="box box-primary">
                        <div class="box-body">


                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    @foreach( LaravelLocalization::getSupportedLocales() as $key => $lang )
                                        <li class="{{ ( $key == LaravelLocalization::getCurrentLocale() ) ? 'active' :'' }}">
                                            <a href="#tab_{{ $key }}" data-toggle="tab">{{ $lang['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach( LaravelLocalization::getSupportedLocales() as $key => $lang )
                                        <div class="tab-pane {{ ( $key == LaravelLocalization::getCurrentLocale() ) ? 'active' :'' }}"
                                             id="tab_{{ $key }}">
                                            <div class="form-group">
                                                <label for="">@lang('shipping.title')</label>
                                                <input type="text" class="form-control"
                                                       name="title_{{$key}}" id="title_{{$key}}" value="{{ old('title_'.$key, $fields->title->$key  ) }}" required/>
                                            </div>
                                            <div class="form-group">
                                                <label for="">@lang('shipping.description')</label>
                                                <input type="text" class="form-control"
                                                       name="description_{{$key}}" id="description_{{$key}}" value="{{ old('description_'.$key, $fields->description->$key  ) }}"/>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">@lang('shipping.code')</label>
                                <input type="text" readonly class="form-control" name="code"
                                       id="code" placeholder="" value="{{ $data->code }}"/>
                            </div>

                            @if( $extracts )
                                @foreach( $extracts as $key => $val )

                                @endforeach
                            @endif

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
