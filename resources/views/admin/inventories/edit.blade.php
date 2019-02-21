
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ route('inventory.index') }}" class="btn btn-info pull-right"><i class="fa fa-mail-reply"></i> @lang('app.back')</a>
        <h1>@lang('app.edit') <a href="{{ route('inventory.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> @lang('app.create')</a></h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <form method="POST" action="{{ route('inventory.update', $data->id ) }}" id="" class="">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="row">

                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">@lang('inventory.name')</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{ old('name', $data->name ) }}"/>
                            </div>

                            <div class="form-group">
                                <label for="">@lang('inventory.contact_name')</label>
                                <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="" value="{{ old('contact_name', $data->contact_name) }}"/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('inventory.contact_phone')</label>
                                <input type="text" class="form-control" name="contact_phone" id="contact_phone" placeholder="" value="{{ old('contact_phone', $data->contact_phone) }}"/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('inventory.contact_fax')</label>
                                <input type="text" class="form-control" name="contact_fax" id="contact_fax" placeholder="" value="{{ old('contact_fax', $data->contact_fax) }}"/>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('inventory.contact_email')</label>
                                <input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="" value="{{ old('contact_email', $data->contact_email) }}"/>
                            </div>

                            <div class="form-group">
                                <label for="">@lang('inventory.description')</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ old('description', $data->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select id="sl-cities" name="matp" class="form-control select2">
                                            @foreach( \App\Models\Cities::select('matp','name')->orderBy('name')->get() as $tp )
                                                <option {{ old('matp',$data->matp) == $tp->matp ? 'selected' : '' }} value="{{ $tp->matp }}">{{ $tp->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select id="sl-district" name="maqh" class="form-control select2">
                                            @foreach( \App\Models\District::where('matp', $data->matp )->orderBy('name')->select('maqh','name')->get() as $qh )
                                                <option {{ old('maqh',$data->maqh) == $qh->maqh ? 'selected' : '' }} value="{{ $qh->maqh }}">{{ $qh->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">

                                        <select id="sl-ward" name="xaid" class="form-control select2">
                                            @foreach( \App\Models\Wards::where('maqh', $data->maqh )->orderBy('name')->select('xaid','name')->get() as $xa )
                                                <option {{ old('xaid',$data->xaid) == $xa->xaid ? 'selected' : '' }} value="{{ $xa->xaid }}">{{ $xa->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">@lang('app.activate')</option>
                                        <option value="0">@lang('app.deactivate')</option>
                                    </select>
                                </div>

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
