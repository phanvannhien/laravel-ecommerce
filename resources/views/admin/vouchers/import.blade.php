
@extends('admin.layouts.app')

@section('content')
    @php
        $program = Config::get('voucher.program');
        $value = Config::get('voucher.value');
    @endphp
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Import voucher</h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <form method="POST" action="{{ route('voucher.import.post') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="voucher">File (.xlsx)</label>
                                <input type="file"
                                       class="form-control" name="file" id="file" placeholder=""/>
                            </div>
                            <button class="btn btn-success btn-sm" type="submit" name="submit" value="check_data">
                                <i class="fa fa-upload"></i> Gửi</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
        <!-- /.box -->
    </section>
    <!-- /.content -->

@stop
