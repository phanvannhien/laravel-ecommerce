
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="{{ route('offices.index') }}" class="btn btn-info pull-right"><i class="fa fa-mail-reply"></i> Quay lại</a>
        <h1>Sửa<a href="{{ route('offices.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Thêm Chi Nhánh</a></h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <form method="POST" action="{{ route('offices.update', $office->office_id ) }}" id="level-form" class="">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="office_name">Tên Chi nhánh <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="office_name" id="office_name" value="{{ $office->office_name }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="office_email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="office_email" id="office_email" value="{{ $office->office_email  }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="office_phone">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="office_phone" id="office_phone" value="{{ $office->office_phone }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="office_address">Địa chỉ (Số và tên đường) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="office_address" id="office_address" value="{{ $office->office_address }}" required/>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="office_address">Thành phố</label>
                                    <select id="sl-cities" name="matp" class="form-control select2" id="">
                                        @foreach( \App\Models\Cities::select('matp','name')->get() as $tp )
                                            <option {{ $office->matp == $tp->matp ? 'selected' : '' }} value="{{ $tp->matp }}">{{ $tp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">

                                    <label for="office_address">Quận/ Huyện</label>
                                    <select id="sl-district" name="maqh" class="form-control select2" id="">
                                        @foreach( \App\Models\District::where('matp', $office->matp )->orderBy('name')->select('maqh','name')->get() as $qh )
                                            <option {{ $office->maqh == $qh->maqh ? 'selected' : '' }} value="{{ $qh->maqh }}">{{ $qh->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="office_address">Phường xã</label>
                                    <select id="sl-ward" name="xaid" class="form-control select2" id="">
                                        @foreach( \App\Models\Wards::where('maqh', $office->maqh )->orderBy('name')->select('xaid','name')->get() as $xa )
                                            <option {{ $office->xaid == $xa->xaid ? 'selected' : '' }} value="{{ $xa->xaid }}">{{ $xa->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Trạng thái</label>

                                <select name="status" id="" class="form-control">
                                    <option {{ ($office->status == 1) ? 'selected' : '' }} value="1">Hoạt động</option>
                                    <option {{ ($office->status == 0) ? 'selected' : '' }} value="0">Khoá hoạt động</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-lg btn-block btn-success">
                                    <i class="fa fa-save"></i> LƯU LẠI
                                </button>

                            </div>
                            <div class="form-group">
                                <a href="{{ route('offices.index') }}" class="btn btn-info btn-block btn-lg "><i class="fa fa-mail-reply"></i> Quay lại</a>
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
    <script>
        $(document).ready(function(){
            $('.colorpicker').colorpicker().on('changeColor', function(e) {
                $(this)[0].style.backgroundColor = e.color.toString('rgba');
            });
        })
    </script>
@stop
