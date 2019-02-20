
@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Tạo ngân hàng</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('offices.store') }}" id="level-form" class="">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-sm-9">
                    <div class="box">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="office_name">Tên Chi nhánh <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="office_name" id="office_name" value="{{ old('office_name') }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="office_email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="office_email" id="office_email" value="{{ old('office_email') }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="office_phone">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="office_phone" id="office_phone" value="{{ old('office_phone') }}" required/>
                            </div>

                            <div class="form-group">
                                <label for="office_address">Địa chỉ (Số và tên đường) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="office_address" id="office_address" value="{{ old('office_address') }}" required/>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="office_address">Thành phố</label>
                                    <select id="sl-cities" name="matp" class="form-control select2" id="">
                                        @foreach( \App\Models\Cities::select('matp','name')->get() as $tp )
                                            <option value="{{ $tp->matp }}">{{ $tp->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="office_address">Quận/ Huyện</label>
                                    <select id="sl-district" name="maqh" class="form-control select2" id="">

                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="office_address">Phường xã</label>
                                    <select id="sl-ward" name="xaid" class="form-control select2" id="">

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
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Khoá hoạt động</option>
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
        var data = {
            "id": 1,
            "text": "Tyto alba",
            "genus": "Tyto",
            "species": "alba"
        };

        $(function () {
            //Initialize Select2 Elements
            $('#sl-cities').select2();
            //$('#sl-district').select2();
//            $('#sl-ward').select2();
            $('#sl-cities').on('select2:select', function (e) {
                var data = e.params.data;
                console.log(data);
                $('#sl-district').select2({
                    ajax: {
                        url: '{{ route('ajax.district')  }}',
                        dataType: 'json',
                        method: 'get',
                        data:{
                            id: data.id
                        },
                        processResults: function (data) {
                            // Tranforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: data
                            };
                        }
                        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                    }
                }).val('').trigger('change');
            });

            $('#sl-district').on('select2:select', function (e) {
                var data = e.params.data;
                console.log(data);
                $('#sl-ward').select2({
                    ajax: {
                        url: '{{ route('ajax.ward')  }}',
                        dataType: 'json',
                        method: 'get',
                        data:{
                            id: data.id
                        },
                        processResults: function (data) {
                            // Tranforms the top-level key of the response object from 'items' to 'results'
                            return {
                                results: data
                            };
                        }
                        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                    }
                }).val('').trigger('change');
            });


        })
    </script>
@stop
