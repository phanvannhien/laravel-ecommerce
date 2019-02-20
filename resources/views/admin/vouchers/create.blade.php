
@extends('admin.layouts.app')

@section('content')
    @php
        $program = Config::get('voucher.program');
        $value = Config::get('voucher.value');

    @endphp
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Voucher<a class="btn btn-success" href="{{ route('voucher.create') }}"><i class="fa fa-plus"></i> Tạo Voucher mới</a></h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form method="POST" action="{{ route('voucher.store') }}" id="signup-form" class="signup-form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="voucher">Mã Voucher</label>
                                <input type="text" value="{{ old('voucher') }}"
                                       class="form-control" name="voucher" id="voucher" placeholder=""/>
                            </div>
                            <div class="form-group">
                                <label for="voucher_value">Giá trị <span class="text-red">*</span></label>
                                <select class="form-control" name="voucher_value" id="">
                                    @foreach($value as $val)
                                        <option {{ (old('voucher_value') == $val) ? 'selected' : '' }}
                                                value="{{ str_replace('.','',$val) }}">{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="program">Chương trình</label>
                                <select name="program" class="form-control" id="">
                                    @foreach($program as $key => $text)
                                        <option {{ (old('program') == $key) ? 'selected' : '' }} value="{{ $key }}">{{$text}}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <div class="box-body">

                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-block btn-success">
                                    <i class="fa fa-save"></i> LƯU LẠI
                                </button>

                            </div>
                            <div class="form-group">
                                <a href="{{ route('voucher.index') }}" class="btn btn-info btn-block btn-lg "><i class="fa fa-mail-reply"></i> Quay lại</a>
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
